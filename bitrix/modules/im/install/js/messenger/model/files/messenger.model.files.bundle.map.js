{"version":3,"sources":["messenger.model.files.bundle.js"],"names":["exports","InsertType","Object","freeze","after","before","ModelFiles","babelHelpers","classCallCheck","this","createClass","key","value","getStore","params","arguments","length","undefined","namespaced","state","host","location","protocol","created","collection","index","actions","set","store","payload","Array","map","file","result","validate","assign","templateId","id","getFileBlank","push","commit","insertType","data","setBefore","message","actionName","update","fields","chatId","BX","Vue","findIndex","el","blink","setTimeout","delete","_delete","mutations","initCollection","_iteratorNormalCompletion","_didIteratorError","_iteratorError","_loop","element","_step","_iterator","Symbol","iterator","next","done","err","return","_iteratorNormalCompletion2","_didIteratorError2","_iteratorError2","_loop2","_step2","unshift","_iterator2","filter","getInstance","getName","convertToArray","object","i","hasOwnProperty","date","Date","type","name","extension","icon","size","image","status","progress","authorId","authorName","urlPreview","urlShow","urlDownload","options","parseInt","toString","typeof","width","height","startsWith","window","Messenger","Model","Files"],"mappings":"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","file":"messenger.model.files.bundle.map.js"}