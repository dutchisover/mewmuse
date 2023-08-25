(function ($) {
  //ローディング
  $(window).on('load', function () {
    $('.loading').addClass('hide');
  });

  // スクロール
  $('a[href^="#"]').on('click', function () {
    // スクロールの速度
    let speed = 500;
    // スクロールタイプ
    let type = 'swing';
    // href属性の取得
    let href = $(this).attr('href');
    // 移動先の取得（hrefが#indexならトップ$(html)に、）
    let target = $(href == '#index' ? 'html' : href);
    // 移動先のポジション取得
    let position = target.offset().top;
    // animateでスムーススクロール
    $('body,html').animate({ scrollTop: position }, speed, type);
    return false;
  });

  // ナビカレント
  // ページURLからパスのみ取得
  const path = location.pathname.split('/');
  // ヘッダーのナビを順に調査
  $('.header_nav a').each(function () {
    // data属性を確認
    const data = $(this).data('current');
    // パスとdata属性が合致していたらclass付与
    if (data == path[1]) {
      $(this)
        .parent()
        .addClass('current');
      // each処理を抜ける
      return false;
    }
  });
})(jQuery);


// ハンバーガーメニュー
const NAV_BUTTON = document.querySelector(".nav_button");
const NAV_CLOSEBUTTON = document.querySelector(".nav_button-close");
const BODY = document.querySelector("body")
const NAV = document.querySelector('.header_nav_list');

function NAV_OPEN() {
  BODY.classList.toggle('nav_open');
}
function NAV_CLOSE() {
  BODY.classList.remove('nav_open');
}

NAV_BUTTON.addEventListener('click', () => {
  NAV_OPEN();
})

NAV_CLOSEBUTTON.addEventListener('click', () => {
  NAV_CLOSE();
})


// モーダル

// 背景スクロール固定
const modal = document.querySelectorAll(".modal_content");

// モーダル表示
const modalBtns = document.querySelectorAll(".modal-toggle");
modalBtns.forEach(function (btn) {
  btn.onclick = function () {
    // .show追加
    const data_modal = btn.getAttribute('data-modal');
    document.getElementById(data_modal).classList.add("show");
  };
});

// モーダル消す
const closeBtns = document.querySelectorAll(".modal-close_button, .modal_bg");
closeBtns.forEach(function (btn) {
  btn.onclick = function () {
    // .show外す
    const this_modal = btn.closest('.modal');
    this_modal.classList.remove("show");
    // スクロールロック解除
    bodyScrollLock.clearAllBodyScrollLocks();
  };
});




// TOPカルーセル
const swiper = new Swiper('.swiper', {
  loop: true,
  effect: 'fade',
  fadeEffect: {
    crossFade: true     //スライドの重なりを解消
  },
  centeredSlides: true,
  speed: 1000,
  slidesPerView: 1,
});


// FAQアコーディオン
const qa = document.querySelectorAll(".js-ac"); // js-ac要素すべて取得
function acToggle() {
  this.closest(".faq_item").classList.toggle("open");
}

for (let i = 0; i < qa.length; i++) { // for文でjs-acメニューをループ処理
  qa[i].addEventListener("click", acToggle);
}


// 高さの最低値
const MAIN = document.querySelector("main");
const FOOTER = document.querySelector("footer");
const FOOTER_H = "calc(100vh - " + FOOTER.offsetHeight + "rem)";
MAIN.style.minHeight = FOOTER_H;
