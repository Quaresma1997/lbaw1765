/**
* Created by Mariana on 21/02/2018.
*/
$(document).ready(function () {
  $("input[name='optionsRadiosType']").click(function (e) {
    let this_size = $(this).attr("id").length;
    var index = $(this).attr("id").substring(this_size - 1, this_size);
    console.log(index);
    $("div.tab-content[name='filter_sort']>div.tab-pane").removeClass("active");
    $("div.tab-content[name='filter_sort']>div.tab-pane").eq(index).addClass("active");

    $("div.tab-content[name='content']>div.tab-pane").removeClass("active");
    $("div.tab-content[name='content']>div.tab-pane").eq(index).addClass("active");


  });

  // $(".dropdown-menu a").click(function () {
  //   var selText = $(this).text();
  //   $(this).parents('.btn-group').find(".btn[name='sort_options']").html(selText);
  // });

});

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
