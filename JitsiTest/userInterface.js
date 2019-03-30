$( document ).ready(function() {
    var domain = "meet.jit.si";
    var options = {
        roomName: "JitsiTest",
        width: 700,
        height: 700,
        parentNode: document.querySelector('#meet')
    }
    var api = new JitsiMeetExternalAPI(domain,options);
});