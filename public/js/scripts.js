// Write your JS below
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
    let url = window.location.href;
    let postId = url.split("/").pop();
    fetchRecords();

    $('#addComment').click(function() {
        var comment = $('#comment').val();

        if(comment !== '') {
            $.ajax({
                url: '/comment/addComment',
                type: 'POST',
                data: {_token: CSRF_TOKEN, comment: comment, postId: postId},
                success: function(response) {
                    if(response > 0) {
                        var id = response;
                        var findnorecord = $('#contactTable tr.norecord').length;

                        if(findnorecord > 0) {
                            $('#contactTable tr.norecord').remove();
                        }

                        var tr_str = "<tr>"+
                            "<td style=\"width: 75%\"><textarea type='text' class=\"form-control registerInput\" rows=\"2\" id='comment"+id+"'>"+ comment +"</textarea></td>" +
                            "<td class=\"text-center\" style=\"text-align: center;vertical-align: middle;\"><button value='Update' data-id='"+id+"' type='button' class='btn btn-light btn-sm commentsButton update'>\ UPADATE </button> <button type='button' value='Delete' class='btn btn-light btn-sm commentsButton delete' data-id='"+id+"'>\n DELETE </button></button></td>"+
                            "</tr>";

                        $("#contactTable tbody").append(tr_str);
                    }

                    $('#comment').val('');
                    fetchRecords();
                }
            });
        } else {
            alert('Fill all fields');
        }
    });


    $(document).on("click", ".update" , function() {
        var editId = $(this).data('id');
        var comment = $('#comment'+ editId).val();

        if(comment != '') {
            $.ajax({
                url: '/comment/updateComment',
                type: 'post',
                data: {_token: CSRF_TOKEN, editId: editId, comment: comment},

                success: function(response) {
                    alert(response);
                }
            });
        } else {
            alert('Fill all fields');
        }
    });

    $(document).on("click", ".delete" , function() {
        var deleteId = $(this).data('id');
        var el = this;

        $.ajax({
            url: '/comment/deleteComment/' + deleteId,
            type: 'get',
            success: function(response) {
                $(el).closest( "tr" ).remove();
                alert(response);
            }
        });
    });

    function fetchRecords(){
        $.ajax({
            url: '/comment/getComments/' + postId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let len = 0;

                $('#commentTable tbody tr:not(:first)').empty(); // Empty <tbody>

                if(response['data'] != null) {
                    len = response['data'].length;
                }

                if (len > 0) {
                    for(var i=0; i<len; i++) {
                        var id = response['data'][i].id;
                        var comment = response['data'][i].comment;

                        var tr_str = "<tr>"+
                            "<td style=\"width: 75%\"><textarea type='text' class=\"form-control registerInput\" rows=\"2\" id='comment"+id+"'>"+ comment +"</textarea></td>" +
                            "<td class=\"text-center\" style=\"text-align: center;vertical-align: middle;\"><button value='Update' data-id='"+id+"' type='button' class='btn btn-light btn-sm commentsButton update'>\ UPDATE </button> <button type='button' value='Delete' class='btn btn-light btn-sm commentsButton delete' data-id='"+id+"'>\n DELETE </button></button></td>"+
                            "</tr>";

                        $("#commentTable tbody").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr class='norecord'>" +
                        "<td align='center' colspan='8'>No comments found.</td>" +
                        "</tr>";

                    $("#commentTable tbody").append(tr_str);
                }
            }
        });
    }
});
