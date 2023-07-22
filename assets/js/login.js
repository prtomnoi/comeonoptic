$(function() {
    $('#signin').submit((e)=> {
        e.preventDefault();
        $.ajax({
            url: 'function',
            type: 'post',
            data : $('#signin').serialize(),
            success: function(data){
               if(data?.data.success === true) {
                  Swal.fire("สำเร็จ", "ยินดีต้อนรับสู่ระบบ COME ON OPTIC..", "success")
                   setTimeout(()=> { window.location.href = data.data.direct },2000)
               }else{
                Swal.fire("ผิดพลาด", "ชื่อผู้ใช้งานหรือรหัสผ่านผิด.", "error");
               }
            }
        })
    });
})
