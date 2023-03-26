<?

class SliderComponent extends CBitrixComponent
{
    public function executeComponent()
    {

        if ($this->startResultCache(60 * 60 * 24 * 7)) {
            $this->fillResult();
            $this->endResultCache();
        }

        $this->includeComponentTemplate();
    }

    protected function fillResult()
    {
        $arResult = [];
        try {
            if (!\Bitrix\Main\Loader::includeModule("iblock")) {
                throw new \Exception();
            }
//dd($this->arParams);
            $arSelect = Array("ID","IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_" . $this->arParams["PROPERTY_CODE"], "PROPERTY_PHOTOS");
            $arFilter = Array("IBLOCK_ID" => IntVal($this->arParams["IBLOCK_ID"]), "ACTIVE" => "Y", "PROPERTY_" . $this->arParams["PROPERTY_CODE"] . "_VALUE" => 'Да');

            $res = \CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, false, $arSelect);
            while ($arFields = $res->GetNext()) {
                if ((int)$arFields['PREVIEW_PICTURE'] > 0){
                    $arResult['PICTURES'][$arFields['PREVIEW_PICTURE']] = ['NAME' => $arFields['NAME'],'ID' => $arFields['ID'], 'DETAIL_PAGE_URL' =>$arFields['DETAIL_PAGE_URL']];
                }
                if ((int)$arFields['PROPERTY_PHOTOS_VALUE'] > 0){
                    $arResult['PICTURES'][$arFields['PROPERTY_PHOTOS_VALUE']] = ['NAME' => $arFields['NAME'],'ID' => $arFields['ID'], 'DETAIL_PAGE_URL' =>$arFields['DETAIL_PAGE_URL']];
                }

            }
        } catch (\Exception $e) {
            $arResult = [];
            $this->abortResultCache();
            $this->_show404Page();
        }
        $this->arResult = $arResult;
//        dd([$this->arParams, $this->arResult]);
    }
}