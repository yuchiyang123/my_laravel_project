/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/aaa.js ***!
  \*****************************/
__webpack_require__.r(__webpack_exports__);
var io = require('socket.io-client');
// 建立 socket.io 的連線
var notification = io.connect('http://localhost:3000');
// 當從 socket.io server 收到 notification 時將訊息印在 console 上
notification.on('notification', function (message) {
  console.log(message);
});
/******/ })()
;