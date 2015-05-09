/**
 * Created by Никита on 06.04.2015.
 */
;
(function ($, Drupal) {
  Drupal.behaviors.shreKit = {
    attach: function (context, settings) {

      // This function generate URL's based on template.
      function createUrl(tpl, variables) {
        return tpl.replace(/\{([^\}]+)\}/g, function (variable, key) {
          return key in variables ? variables[key] : variable;
        });
      }

      // Open PopUp.
      function shareButtonClick(ShareInfo) {
        // Calculate position for centering PopUp window.
        var left = Math.round(screen.width / 2 - ShareInfo.PopupWidth / 2);
        var top = 0;
        if (screen.height > ShareInfo.PopupHeight) {
          top = Math.round(screen.height / 3 - ShareInfo.PopupHeight / 2);
        }

        var urlTemplate = ShareUrls[ShareInfo.SocialNetwork];
        var socialNetwork = String(ShareInfo.SocialNetwork);

        // Generate URL.
        var url = createUrl(urlTemplate, {
          url: ShareInfo.ShareUrl,
          title: ShareInfo.ShareTitle
        });

        var PopUp = window.open(url, this.service, 'left=' + left + ',top=' + top + ',width=' + ShareInfo.PopupWidth + ',height=' + ShareInfo.PopupHeight + ',personalbar=0,toolbar=0,scrollbars=1,resizable=1');
        if (PopUp) {
          PopUp.focus();
        }
        else {
          location.href = url;
        }
      }

      var protocol = location.protocol;
      var ShareKitButtons = $('.sharekit', context);
      var ShareKit = [];
      var ShareUrls = {
        facebook: 'https://www.facebook.com/sharer/sharer.php?u={url}',
        twitter: 'https://twitter.com/intent/tweet?url={url}&text={title}',
        plusone: 'https://plus.google.com/share?url={url}',
        vkontakte: protocol + '//vk.com/share.php?url={url}&title={title}',
        mailru: protocol + '//connect.mail.ru/share_count?url_list={url}&callback=1&func=?',
        odnoklassniki: 'http://connect.ok.ru/dk?st.cmd=WidgetSharePreview&service=odnoklassniki&st.shareUrl={url}',
        pinterest: protocol + '//pinterest.com/pin/create/button/?url={url}&description={title}'
      };

      ShareKitButtons.each(function (index) {
        // Store instance of button.
        var ShareKitButton = $(this);

        ShareKit[index] = {
          SocialNetwork: $(this).data('social-network'),
          ShareUrl: $(this).data('share-url'),
          ShareTitle: $(this).data('share-title'),
          PopupWidth: $(this).data('popup-width'),
          PopupHeight: $(this).data('popup-height')
        };

        // Bind click to all element.
        if ($(this).data('popup')) {
          $(this).bind('click', function () {
            shareButtonClick(ShareKit[index]);
          });
        }
        // Bind for inner, if main wrapper not clickable.
        else {
          $(this).find('[data-popup="true"]').each(function (key, value) {
            $(value).bind('click', function () {
              shareButtonClick(ShareKit[index]);
            });
          });
        }

      });
    }
  }
})(jQuery, Drupal);