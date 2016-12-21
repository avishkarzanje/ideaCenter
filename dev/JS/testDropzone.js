$(document).ready(function(){
    var dz = $("div#myId").dropzone({ url: "Upload.php", maxFiles: 1, autoProcessQueue: false, addRemoveLinks: true, acceptedFiles: 'image/*' });

    $(".btn").click(function(){
        dz.processQueue();
    });
});
