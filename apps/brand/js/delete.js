$(document).ready(function(){
    var type_txt;
    if(language == "th"){
        $(".table").DataTable({
            responsive: true,
            sort: false,
            "oLanguage":{
                "sEmptyTable":     "ไม่มีข้อมูลในตาราง",
                "sInfo":           "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "sInfoEmpty":      "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered":   "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "แสดง _MENU_ แถว",
                "sLoadingRecords": "กำลังโหลดข้อมูล...",
                "sProcessing":     "กำลังดำเนินการ...",
                "sSearch":         "ค้นหา: ",
                "sZeroRecords":    "ไม่พบข้อมูล",
                "oPaginate": {
                    "sFirst":    "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                    "sNext":     "ถัดไป",
                "sLast":     "หน้าสุดท้าย"
                },
                "oAria": {
                    "sSortAscending":  ": Enabled การเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": Enabled การเรียงข้อมูลจากมากไปน้อย"
                }
            }
        });
    }else{
        $(".table").DataTable({
            responsive: true,
            sort: false,
        });
    }
  

    if(msg){

        if(status == true){
            type_txt = "success";
        }else{
            type_txt = "error";
        }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    

      Toast.fire({
        type: type_txt,
        title: '&nbsp;&nbsp;'+msg
      })

    }
})


$('#modalDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var brand_id = button.data('brand-id')
    var brand_name = button.data('brand-name')
    var modal = $(this)
    modal.find('.modal-body span').text(alert_delete_modal)

    $("#modalDelete .btn-continue").off();
    $("#modalDelete .btn-continue").on("click", function(){
        window.location.href="apps/brand/do_brand.php?action=confirm_delete&brand_id="+brand_id
    })
  })
