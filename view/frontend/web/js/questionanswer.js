define([
    'jquery'
], function($) {
    'use strict';
        /*answer button toggle*/
         $(".answerbutton").click(function(){
            $(this).next('div').slideToggle();
        });
        /*Load more code*/
        var QuestionConfigure=$('#QuestionConfigure').val();    
        $(".questionanswer").slice(0, QuestionConfigure).show();
        $("body").on('click touchstart', '.load-more', function (e) {
            e.preventDefault();
            $(".questionanswer:hidden").slice(0, QuestionConfigure).slideDown();
            if ($(".questionanswer:hidden").length == 0) {
                $(".load-more").css('visibility', 'hidden');
            }
        });
        /*close Load more code*/
        /*more less code*/
        $('.more-text').hide();
        $(".moreless-button").click(function(){
          var elmId = ($(this)).attr("data-id");
          var eldiv = '.answers_'+elmId;
          $(eldiv).slideToggle();
          if($(this).text() == 'read more'){
             $(this).text('read less');
         } else {
             $(this).text('read more');
         }
       });
       /* close more less code*/
});