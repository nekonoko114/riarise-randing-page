"use strict";

var _Swiper;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var swiper = new Swiper(".swiper", (_Swiper = {
  loop: true,
  // ループ有効
  slidesPerView: 5,
  // 一度に表示する枚数
  speed: 6000,
  // ループの時間
  allowTouchMove: false,
  // スワイプ無効
  autoplay: {
    delay: 0 // 途切れなくループ

  }
}, _defineProperty(_Swiper, "slidesPerView", 1), _defineProperty(_Swiper, "breakpoints", {
  // スライドの表示枚数：500px以上の場合
  500: {
    slidesPerView: 3
  }
}), _Swiper));