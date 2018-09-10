$(document).ready(function () {

    $('#showpass').hide();
    $('#password').keyup(function () {
        $('#showpass').show();
        $('#showpass').mousedown(function () {
            $('#password').attr('type','text');
            $('#showpass').mouseup(function () {
                $('#password').attr('type','password');
            });
        });
        $('#password').mouseout(function () {
            $('#showpass').hide();
            $('#password').hover(function () {
                $('#showpass').show();
            });
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $('.cate').click(function () {
          var cate=($(this).attr('val'));
          $('.cate').css('color','red');
          $(this).css('color','blue');
          $.ajax
          ({
           'url' :  'ajaxcate/',
           'type':  'POST',
           'data':   {'id' : cate},
           success:function (data) {
               $('#cate').html(data);

           }
          });




    $(".eidt").click(function () {
        var rowid = $(this).attr('id');
        var qty = $(this).parent().parent().find(".soluong").val();
        if (isNaN(qty))
        {
          return  alert('bạn phải nhập đúng định dạng số');
        }
        var token = $("input[name='_token']").val();
        $.ajax({
            url: 'editproduct/' + rowid + '/' + qty,
            type: 'POST',
            cache: false,
            data: {"_token": token, "id": rowid, "qty": qty},
            success: function (data) {

                window.location.href = "checkout";
            }

        });
    });


});
});
