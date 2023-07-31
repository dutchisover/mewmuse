(function($) {
  //ローディング
  $(window).on('load', function() {
    $('.loading').addClass('hide');
  });

  // スクロール
  $('a[href^="#"]').on('click', function() {
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
  $('.header_nav a').each(function() {
    // data属性を確認
    const data = $(this).data('current');
    // console.log(path[2]);
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
