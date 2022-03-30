if (document.URL.match(/company\/edit/)) {
    const startBtn = $('#start');
    const stopBtn = $('#stop');
    let recoder;

    navigator.mediaDevices.getUserMedia({
        audio: true
    })
        .then(function (stream) {
            recoder = new MediaRecorder(stream);
            startBtn.on('click', startRecording);
            stopBtn.on('click', stopRecording);
            recoder.addEventListener('dataavailable', setRecoding);
        })

    startRecording = () => {
        recoder.start();
        startBtn.prop('disabled', true);
        stopBtn.prop('disabled', false);
    }

    stopRecording = () => {
        recoder.stop();
        startBtn.prop('disabled', false);
        stopBtn.prop('disabled', true);
    }

    setRecoding = (e) => {
        let audio = document.getElementById("audio");
        audio.src = URL.createObjectURL(e.data);
        audio.play();
    }
}
