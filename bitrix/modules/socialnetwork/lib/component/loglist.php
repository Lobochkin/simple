<?php
namespace Bitrix\Socialnetwork\Component;

use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Error;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Socialnetwork\Component\LogList\Gratitude;
use Bitrix\Socialnetwork\Component\LogList\Util;
use Bitrix\Socialnetwork\Component\LogList\Param;
use Bitrix\Socialnetwork\Component\LogList\Path;
use Bitrix\Socialnetwork\Component\LogList\ParamPhotogallery;
use Bitrix\Socialnetwork\Component\LogList\Processor;
use Bitrix\Socialnetwork\Component\LogList\Page;
use Bitrix\Socialnetwork\Component\LogList\Counter;

class LogList extends \CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable, \Bitrix\Main\Errorable
{
	/** @var ErrorCollection errorCollection */
	protected $errorCollection;

	protected $extranetSite = false;
	protected $presetFilterTopId = false;
	protected $presetFilterId = false;
	protected $commentsNeeded = false;
	protected $currentUserAdmin = false;
	protected $activity2LogList = [];
	protected $diskUFEntityList = [
		'BLOG_POST' => [],
		'SONET_LOG' => []
	];

	protected $request = null;
	protected $gratitudesInstance = null;
	protected $paramsInstance = null;
	protected $pathInstance = null;
	protected $paramsPhotogalleryInstance = null;
	protected $processorInstance = null;
	protected $logPageProcessorInstance = null;
	protected $counterProcessorInstance = null;

	public $useLogin = false;

	public static $canCurrentUserAddComments = [];

	public function configureActions()
	{
		return [];
	}

	public function getErrorByCode($code)
	{
		return $this->errorCollection->getErrorByCode($code);
	}

	/**
	 * Getting array of errors.
	 * @return Error[]
	 */
	public function getErrors()
	{
		return $this->errorCollection->toArray();
	}

	protected function printErrors()
	{
		foreach($this->errorCollection as $error)
		{
			ShowError($error);
		}
	}

	protected function getRequest()
	{
		if ($this->request == null)
		{
			$this->request = Util::getRequest();
		}

		return $this->request;
	}

	public function setExtranetSiteValue($value = false)
	{
		$this->extranetSite = ($value === true);
	}
	public function getExtranetSiteValue()
	{
		return $this->extranetSite;
	}

	public function setPresetFilterTopIdValue($value)
	{
		$this->presetFilterTopId = $value;
	}
	public function getPresetFilterTopIdValue()
	{
		return $this->presetFilterTopId;
	}

	public function setPresetFilterIdValue($value)
	{
		$this->presetFilterId = $value;
	}
	public function getPresetFilterIdValue()
	{
		return $this->presetFilterId;
	}

	public function setCommentsNeededValue($value = false)
	{
		$this->commentsNeeded = ($value === true);
	}
	public function getCommentsNeededValue()
	{
		return $this->commentsNeeded;
	}

	public function setCurrentUserAdmin($value = false)
	{
		$this->currentUserAdmin = $value;
	}
	public function getCurrentUserAdmin()
	{
		return $this->currentUserAdmin;
	}

	public function setActivity2LogListValue($value = [])
	{
		$this->activity2LogList = $value;
	}
	public function getActivity2LogListValue()
	{
		return $this->activity2LogList;
	}

	public function setDiskUFEntityListValue($value = [])
	{
		$this->diskUFEntityList = $value;
	}
	public function getDiskUFEntityListValue()
	{
		return $this->diskUFEntityList;
	}

	protected function processParentParams(&$params)
	{
		$parent = $this->getParent();
		if(is_object($parent) && strlen($parent->__name) > 0)
		{
			$this->getParamsInstance()->prepareParentParams($params);
			$this->getParamsPhotogalleryInstance()->prepareParentPhotogalleryParams($params);

			// parent of 2nd level
			$parent2 = $parent->getParent();
			if(is_object($parent2) && strlen($parent2->__name) > 0)
			{
				$this->getParamsInstance()->prepareParent2Params($params);
			}
		}
	}

	protected function getGratitudesInstance()
	{
		if($this->gratitudesInstance === null)
		{
			$this->gratitudesInstance = new Gratitude([
				'component' => $this
			]);
		}

		return $this->gratitudesInstance;
	}

	protected function getParamsInstance()
	{
		if($this->paramsInstance === null)
		{
			$this->paramsInstance = new Param([
				'component' => $this,
				'request' => $this->getRequest()
			]);
		}

		return $this->paramsInstance;
	}

	public function getPathInstance()
	{
		if($this->pathInstance === null)
		{
			$this->pathInstance = new Path([
				'component' => $this,
				'request' => $this->getRequest()
			]);
		}

		return $this->pathInstance;
	}

	public function getParamsPhotogalleryInstance()
	{
		if($this->paramsPhotogalleryInstance === null)
		{
			$this->paramsPhotogalleryInstance = new ParamPhotogallery([
				'component' => $this
			]);
		}

		return $this->paramsPhotogalleryInstance;
	}

	protected function getProcessorInstance()
	{
		if($this->processorInstance === null)
		{
			$this->processorInstance = new Processor([
				'component' => $this,
				'request' => $this->getRequest()
			]);
		}

		return $this->processorInstance;
	}

	public function getLogPageProcessorInstance()
	{
		if($this->logPageProcessorInstance === null)
		{
			$this->logPageProcessorInstance = new Page([
				'component' => $this,
				'request' => $this->getRequest(),
				'processorInstance' => $this->getProcessorInstance()
			]);
		}

		return $this->logPageProcessorInstance;
	}

	public function getCounterProcessorInstance()
	{
		if($this->counterProcessorInstance === null)
		{
			$this->counterProcessorInstance = new Counter([
				'component' => $this,
				'request' => $this->getRequest(),
				'processorInstance' => $this->getProcessorInstance()
			]);
		}

		return $this->counterProcessorInstance;
	}

	public function onPrepareComponentParams($params)
	{
		global $USER;

		$this->errorCollection = new ErrorCollection();

		$request = $this->getRequest();
		$paramsInstance = $this->getParamsInstance();
		$pathInstance = $this->getPathInstance();

		$this->setExtranetSiteValue((Loader::includeModule('extranet') && \CExtranet::isExtranetSite()));
		$this->setCommentsNeededValue(
			strlen($request->get('log_filter_submit')) > 0
			&& $request->get('flt_comments')== 'Y'
		);

		Util::checkEmptyParamInteger($params, 'LOG_CNT', 0);
		Util::checkEmptyParamInteger($params, 'PAGE_SIZE', 20);
		Util::checkEmptyParamString($params, 'PUBLIC_MODE', 'N');
		Util::checkEmptyParamString($params, 'SHOW_EVENT_ID_FILTER', 'Y');
		Util::checkEmptyParamInteger($params, 'LOG_ID', 0);

		$params['HIDE_EDIT_FORM'] = ($params['LOG_ID'] > 0 ? 'Y' : (isset($params['HIDE_EDIT_FORM']) ? $params['HIDE_EDIT_FORM'] : 'N'));
		$params['SHOW_EVENT_ID_FILTER'] = ($params['LOG_ID'] > 0 ? 'N' : $params['SHOW_EVENT_ID_FILTER']);
		$params['AUTH'] = (isset($params['AUTH']) && strToUpper($params['AUTH']) == 'Y' ? 'Y' : 'N');

		$paramsInstance->prepareModeParams($params);
		$paramsInstance->prepareFollowParams($params);

		Util::checkEmptyParamString($params, 'CHECK_PERMISSIONS_DEST', 'N');

		$params['IS_CRM'] = (
			!ModuleManager::isModuleInstalled('crm')
				? 'N'
				: (
					isset($params['IS_CRM'])
						? $params['IS_CRM']
						: 'N'
				)
		);

		$params['SHOW_LOGIN'] = (isset($params['SHOW_LOGIN']) ? $params['SHOW_LOGIN'] : 'Y');
		$this->useLogin = ($params['SHOW_LOGIN'] != 'N');

		$params['SHOW_UNREAD'] = ($USER->isAuthorized() && $params['LOG_ID'] <= 0 && $params['MODE'] != 'LANDING' ? 'Y' : 'N');

		$paramsInstance->prepareRatingParams($params);
		$paramsInstance->prepareRequestVarParams($params);
		$pathInstance->setPaths($params);
		$paramsInstance->prepareRequestParams($params);
		$paramsInstance->prepareNameTemplateParams($params);
		$paramsInstance->prepareAvatarParams($params);
		$paramsInstance->prepareCommentsParams($params);
		$paramsInstance->prepareDestinationParams($params);
		$paramsInstance->prepareCommentPropertyParams($params);
		$paramsInstance->prepareDateTimeFormatParams($params);
		$paramsInstance->prepareCounterParams($params);
		$paramsInstance->preparePageParams($params);
		$paramsInstance->processPresetFilterParams($params);
		$paramsInstance->prepareDateFilterParams($params);
		$this->processParentParams($params);
		$this->getParamsPhotogalleryInstance()->preparePhotogalleryParams($params);
		$paramsInstance->preparePageTitleParams($params);
		$paramsInstance->prepareBehaviourParams($params);

		Util::checkEmptyParamString($params, 'PAGER_TITLE', '');

		return $params;
	}

	protected function prepareData()
	{
		global $USER;

		$request = $this->getRequest();
		$processorInstance = $this->getProcessorInstance();
		$logPageProcessorInstance = $this->getLogPageProcessorInstance();
		$counterProcessorInstance = $this->getCounterProcessorInstance();
		$pathsProcessorInstance = $this->getPathInstance();

		$result = [];

		$this->getGratitudesInstance()->prepareGratPostFilter($result);

		$result['isExtranetSite'] = $this->getExtranetSiteValue();
		$result['SHOW_FOLLOW_CONTROL'] = $this->arParams['USE_FOLLOW'];
		$result['CAN_DELETE'] = \CSocNetUser::isCurrentUserModuleAdmin(SITE_ID, false);
		$result['ENTITIES_CORRESPONDENCE'] = [];

		$result['PATH_TO_LOG_TAG'] = $pathsProcessorInstance->getFolderUsersValue().'log/?TAG=#tag#';
		if (
			defined('SITE_TEMPLATE_ID')
			&& SITE_TEMPLATE_ID == 'bitrix24'
		)
		{
			$result['PATH_TO_LOG_TAG'] .= '&apply_filter=Y';
		}

		$result['AJAX_CALL'] = (strlen($request->get('logajax')) > 0);
		$result['bReload'] = ($result['AJAX_CALL'] && $request->get('RELOAD') == 'Y');
		$result['SHOW_UNREAD'] = $this->arParams['SHOW_UNREAD'];
		$result['currentUserId'] = intval($USER->getId());

		$logPageProcessorInstance->preparePrevPageLogId();
		$this->setCurrentUserAdmin(\CSocNetUser::isCurrentUserModuleAdmin());
		$processorInstance->getMicroblogUserId($result);

		$result['TZ_OFFSET'] = \CTimeZone::getOffset();
		$result['FILTER_ID'] = (
		!empty($this->arParams['FILTER_ID'])
			? $this->arParams['FILTER_ID']
			: 'LIVEFEED'.(!empty($this->arParams['GROUP_ID']) ? '_SG'.$this->arParams['GROUP_ID'] : '')
		);

		\CSocNetTools::initGlobalExtranetArrays();

		if (
			Util::checkUserAuthorized()
			|| $this->arParams['AUTH'] == 'Y'
		)
		{
			$result['IS_FILTERED'] = false;


			$processorInstance->prepareContextData($result);
			$this->setTitle();

			$result['Events'] = false;

			$processorInstance->processFilterData($result);
			$processorInstance->processNavData($result);
			$processorInstance->processOrderData();
			$counterProcessorInstance->processCounterTypeData($result);
			$processorInstance->processLastTimestamp($result);
			$processorInstance->processListParams($result);
			$logPageProcessorInstance->getLogPageData($result);
			$processorInstance->setListFilter($result);
			$processorInstance->processSelectData();

			$this->getEntriesData($result);
			$processorInstance->processFavoritesData($result);

			$processorInstance->processDiskUFEntities();
			$processorInstance->processCrmActivities($result);
			$logPageProcessorInstance->deleteLogPageData($result);

			$processorInstance->processNextPageSize($result);
			$processorInstance->processEventsList($result);

			if (
				$this->arParams['LOG_ID'] > 0
				&& (
					!is_array($result['Events'])
					|| count($result['Events']) <= 0
				)
			)
			{
				$this->errorCollection[] = new Error(Loc::getMessage('SONET_LOG_LIST_ENTRY_NOT_FOUND'));
				return false;
			}

			$processorInstance->processContentList($result);

			$result['WORKGROUPS_PAGE'] = $pathsProcessorInstance->getFolderWorkgroupsValue();

			$counterProcessorInstance->setLogCounter($result);
			$processorInstance->getExpertModeValue($result);
			$logPageProcessorInstance->setLogPageData($result);
			$counterProcessorInstance->clearLogCounter($result);
			$this->processLogFormComments($result);

			$result['bGetComments'] = $this->getCommentsNeededValue();
			$result['GET_COMMENTS'] = ($this->getCommentsNeededValue() ? 'Y' : 'N');

			$processorInstance->getSmiles($result);
		}
		else
		{
			$result['NEED_AUTH'] = 'Y';
		}

		// compatibility with old component/template
		$this->arParams['SHOW_UNREAD'] = $result['SHOW_UNREAD'];

		return $result;
	}

	protected function getEntriesData(&$result)
	{
		$result['arLogTmpID'] = [];

		if (empty($result['RETURN_EMPTY_LIST']))
		{
			$this->getEntryIdList($result);

			if (
				count($result['arLogTmpID']) <= 0
				&& $this->getLogPageProcessorInstance()->getNeedSetLogPage() // no log pages for user
			)
			{
				$this->getLogPageProcessorInstance()->setDateLastPageStart(null);
				$this->getProcessorInstance()->unsetFilterKey('>=LOG_UPDATE');
				$this->getEntryIdList($result);
			}
		}
	}

	protected function getEntryIdList(&$result)
	{
		global $NavNum;

		$processorInstance = $this->getProcessorInstance();

		if ($processorInstance->getListParamsKey('EMPTY_LIST') == 'Y')
		{
			$result['arLogTmpID'] = [];
			return;
		}

		$res = \CSocNetLog::getList(
			$processorInstance->getOrder(),
			$processorInstance->getFilter(),
			false,
			$processorInstance->getNavParams(),
			$processorInstance->getSelect(),
			$processorInstance->getListParams()
		);

		if ($processorInstance->getFirstPage())
		{
			$result['NAV_STRING'] = '';
			$result['PAGE_NAVNUM'] = $NavNum+1;
			$result['PAGE_NAVCOUNT'] = 1000000;
		}
		else
		{
			$navComponentObject = false;
			$result['NAV_STRING'] = $res->getPageNavStringEx($navComponentObject, Loc::getMessage('SONET_LOG_LIST_NAV'), '', false);
			$result['PAGE_NUMBER'] = $res->NavPageNomer;
			$result['PAGE_NAVNUM'] = $res->NavNum;
			$result['PAGE_NAVCOUNT'] = $res->NavPageCount;
		}

		$cnt = 0;
		while ($eventFields = $res->getNext())
		{
			if ($eventFields['MODULE_ID'] == 'crm_shared')
			{
				$eventFields['MODULE_ID'] = 'crm';
			}

			if (
				!ModuleManager::isModuleInstalled('bitrix24')
				&& (
					(
						!empty($eventFields['MODULE_ID'])
						&& !ModuleManager::isModuleInstalled($eventFields['MODULE_ID'])
					)
					||
					(
						in_array($eventFields['EVENT_ID'], [ 'timeman_entry', 'report' ])
						&& !ModuleManager::isModuleInstalled('timeman')
					)
					|| (
						in_array($eventFields['EVENT_ID'], [ 'tasks' ])
						&& !ModuleManager::isModuleInstalled('tasks')
					)
					|| (
						in_array($eventFields['EVENT_ID'], [ 'lists_new_element' ])
						&& !ModuleManager::isModuleInstalled('lists')
					)
				)
			)
			{
				continue;
			}

			if (in_array($eventFields['EVENT_ID'], [ 'crm_activity_add' ]))
			{
				$activity2LogList = $this->getActivity2LogListValue();
				$activity2LogList[$eventFields['ENTITY_ID']] = $eventFields['ID'];
				$this->setActivity2LogListValue($activity2LogList);
				unset($activity2LogList);
			}

			$cnt++;
			if ($cnt == 1)
			{
				$result['CURRENT_PAGE_DATE'] = (
				$res->NavPageNomer > 1
					? $eventFields['LOG_UPDATE']
					: convertTimeStamp(time() + $result['TZ_OFFSET'], 'FULL')
				);
			}
			$result['arLogTmpID'][] = $eventFields['ID'];

			$processorInstance->appendEventsList($eventFields);

			$livefeedProvider = new \Bitrix\Socialnetwork\Livefeed\BlogPost();

			if (
				in_array($eventFields['EVENT_ID'], array_merge($livefeedProvider->getEventId(), [ 'idea' ]))
				&& intval($eventFields['SOURCE_ID']) > 0
			)
			{
				$diskUFEntityList = $this->getDiskUFEntityListValue();
				$diskUFEntityList['BLOG_POST'][] = $eventFields['SOURCE_ID'];
				$this->setDiskUFEntityListValue($diskUFEntityList);
				unset($diskUFEntityList);
			}
			elseif (!in_array($eventFields['EVENT_ID'], [ 'data', 'photo', 'photo_photo', 'bitrix24_new_user', 'intranet_new_user', 'news' ]))
			{
				$diskUFEntityList = $this->getDiskUFEntityListValue();
				$diskUFEntityList['SONET_LOG'][] = $eventFields['ID'];
				$this->setDiskUFEntityListValue($diskUFEntityList);
				unset($diskUFEntityList);
			}
		}
	}

	protected function processLogFormComments(&$result)
	{
		global $USER_FIELD_MANAGER;

		$params = $this->arParams;

		if (
			empty($this->getErrors())
			&& Util::checkUserAuthorized()
			&& !$result['AJAX_CALL']
		)
		{
			$cache = new \CPHPCache;
			$cacheId = 'log_form_comments'.serialize($params['COMMENT_PROPERTY']);
			$cachePath = '/sonet/log_form/comments';
			$ttl = (defined('BX_COMP_MANAGED_CACHE') ? 2592000 : 600);

			if ($cache->initCache($ttl, $cacheId, $cachePath))
			{
				$cacheVars = $cache->getVars();
				$result['COMMENT_PROPERTIES'] = $cacheVars['comment_props'];
				$cache->output();
			}
			else
			{
				$cache->startDataCache($ttl, $cacheId, $cachePath);

				$result['COMMENT_PROPERTIES'] = [ 'SHOW' => 'N' ];
				if (
					!empty($params['COMMENT_PROPERTY'])
					&& is_array($params['COMMENT_PROPERTY'])
				)
				{
					$arPostFields = $USER_FIELD_MANAGER->getUserFields('SONET_COMMENT', 0, LANGUAGE_ID);
					foreach ($arPostFields as $fieldName => $fieldData)
					{
						if (!in_array($fieldName, $params['COMMENT_PROPERTY']))
						{
							continue;
						}

						$fieldData['EDIT_FORM_LABEL'] = strLen($fieldData['EDIT_FORM_LABEL']) > 0 ? $fieldData['EDIT_FORM_LABEL'] : $fieldData['FIELD_NAME'];
						$fieldData['~EDIT_FORM_LABEL'] = $fieldData['EDIT_FORM_LABEL'];
						$fieldData['EDIT_FORM_LABEL'] = htmlspecialcharsEx($fieldData['EDIT_FORM_LABEL']);
						$result['COMMENT_PROPERTIES']['DATA'][$fieldName] = $fieldData;
					}

					if (!empty($result['COMMENT_PROPERTIES']['DATA']))
					{
						$result['COMMENT_PROPERTIES']['SHOW'] = 'Y';
					}
				}

				$cache->endDataCache([ 'comment_props' => $result['COMMENT_PROPERTIES'] ]);
			}
		}
	}

	public static function getGratitudesIblockId()
	{
		return Gratitude::getGratitudesIblockId();
	}

	public static function getGratitudesIblockData(array $params = [])
	{
		return LogList\Gratitude::getGratitudesIblockData($params);
	}

	public static function getGratitudesBlogData(array $params = [])
	{
		return LogList\Gratitude::getGratitudesBlogData($params);
	}
}
?>