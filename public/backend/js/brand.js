$(function() {
    $('.js-deleteBrand').on('click', function(){
        let self = $(this);
        let idBrand = self.attr('id');
        if($.isNumeric(idBrand)){
            $.ajax({
                url: urlDeleteBrand,
                type: "post",
                data: {id: idBrand},
                beforeSend: function(){
                    self.text('Loading ...');
                },
                success: function(result){
                    self.text('Delete');
                    //let dataResult = $.parseJSON(result);
                    //console.log(result);
                    if(result.code === 200){
                        alert('xoa thanh cong');
                        window.location.reload(true);
                    }
                }
            })
        } else {
            alert('co loi xay ra - vui long thu lai');
        }
    });
});