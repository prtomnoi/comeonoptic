// $('#form-setting').submit(function(e) {
//     e.preventDefault();
//     $.ajax({
//         url: "update_provider.php",
//         type: 'post',
//         data: $("#form-setting").serialize(),
//         success: function(data) {
//             Swal.fire({
//                 icon: 'success',
//                 title: 'Congratulations',
//                 text: 'Update data successfully!',
              
//               })
//         }
//     });
// });
function delete_data(id , url){
    Swal.fire({
        title: 'แจ้งเตือน?',
        text: "คุณต้องการลบรายการนี้หรือไม่!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
      }).then((result) => {
        if (result.isConfirmed) {
         $.get(url+'?del='+id , function(){
            Swal.fire(
                'สำเร็จ!',
                'ทำรายการเสร็จสิ้น.',
                'success'
              ).then(()=> location.reload());
         });
       
        }
      })
}