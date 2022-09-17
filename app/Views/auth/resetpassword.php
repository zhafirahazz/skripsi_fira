<div class="card mt-5 shadow" style="max-width: 500px; margin:auto;">
    <div class="card-header text-center">
        <h4><b>Reset Password</b></h4>
    </div>
    <div class="card-body">
        <img class="img-thumbnail text-center img-200" src="/img/abbskp.png" style="margin: 5vh auto" />
        <div>
            <input required class="form form-control" id="pwd-input" placeholder="Password" name="pwd" type="password">
            <input required class="form mt-2 form-control" id="cpwd-input" placeholder="Konfirmasi Password" name="cpwd" type="password">
            <input required class="form mt-2 form-control" id="code-input" name="code" type="hidden" value="<?= $code ?>">
            <button class="btn mt-4 btn-primary w-100" onclick="sendRequest()" id="reset-btn">Reset Password</button>
        </div>
        <div class="text-center mt-4" id="message">

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    let message =  document.getElementById('message')
    async function sendRequest() {
        const url = "<?php echo route_to('auth.forgot.update') ?>"
        let payload = {
            "pwd": document.getElementById('pwd-input').value,
            "cpwd": document.getElementById('cpwd-input').value,
            "code": document.getElementById('code-input').value,
        }

        if (payload.pwd == '' || payload.pwd == null) {
            onError('Password tidak boleh kosong!')
            return;
        }

        if (payload.cpwd == '' || payload.pwd == null) {
            onError('Konfirmasi password tidak boleh kosong!')
            return
        }

        if(payload.cpwd != payload.pwd){
            onError('Password dan konfirmasi password harus sama!')
            return
        }

        message.innerHTML = "<p>Harap tunggu ...</p>"
        await axios.post(url, payload, {
                header: {
                    'Content-Type': "application/json",
                    'Accept': "application/json"
                }
            }).then((r) => {
                console.log(r)
                onSuccess(`Password berhasil di ubah, silahkan login! <a href="/auth/login"> Login </a>`)
            })
            .catch((e) => {
                console.log(e)
                if (e.response) {
                    switch (e.response.data.code) {
                        case 4001: {
                            onError("Permintaan tidak ditemukan")
                            return
                        }
                        case 4002: {
                            onError("Permintaan telah kadaluarsa")
                            return
                        }
                        case 4003: {
                            onError("Pengguna tidak ditemukan")
                            return
                        }
                        default: {
                            onError(e.message)
                            return
                        }
                    }
                }
                onError(e.message)
            });
    }

    function onSuccess(msg) {
        message.innerHTML = `<p class='text-success'>${msg}</p>`
    }

    function onError(msg) {
        message.innerHTML = `<p class='text-danger'>${msg}</p>`
    }
</script>