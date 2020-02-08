/**
 * Created by thomas on 1/7/2016.
 */
(function($) {
    $.entwine(function($) {

        $("#Form_ItemEditForm_LandInAcre").entwine({
            onfocusout: function(){
                var landInAcre = $("#Form_ItemEditForm_LandInAcre");
                var landInCent = $("#Form_ItemEditForm_LandInCent");
                var inCent = $("#Form_ItemEditForm_InCent");
                var result = (landInAcre.val()*100) + Math.floor(landInCent.val());
                if(!isNaN(result)) {
                    inCent.val(result);
                    return;
                }
                inCent.val('');
            }
        });

        $("#Form_ItemEditForm_LandInCent").entwine({
            onfocusout: function(){
                var landInAcre = $("#Form_ItemEditForm_LandInAcre");
                var landInCent = $("#Form_ItemEditForm_LandInCent");
                var inCent = $("#Form_ItemEditForm_InCent");
                var result = (landInAcre.val()*100) + Math.floor(landInCent.val());
                if(!isNaN(result)) {
                    inCent.val(result);
                    return;
                }
                inCent.val('');
            }
        });

        /**
         * Class: .cms-edit-form .field.switchable
         *
         * Hide each switchable field except for the currently selected link type
         */
        $('.cms-edit-form .field.switchable').entwine({
            onmatch: function() {
                var id = this.attr('id'),
                    form = this.closest('form');

                if(form.find('input[name=LinkType]:checked').val() !== id) {
                    this.hide();
                }

                this._super();
            }
        });

        /**
         * Input: .cms-edit-form input[name=LinkType]
         *
         * On click of radio button, show selected field, hide all others
         */
        $('.cms-edit-form input[name=LinkType]').entwine({
            onclick: function() {
                var id = this.val(),
                    form = this.closest('form');

                form.find('.field.switchable').hide();
                form.find('#' + id).show();

                this._super();
            }
        });
    });
})(jQuery);
