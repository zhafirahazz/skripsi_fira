<div class="card mt-5 shadow" style="max-width: 500px; margin:auto;">
    <div class="card-header text-center">
        <h4><b>Login</b></h4>
    </div>
    <div class="card-body">
        <img class="img-thumbnail text-center img-200" src="/img/abbskp.png" style="margin: 5vh auto" />
        <h3>Akun anda belum diverifikasi! <?= $id ?></h3>
        <div class="text-center">
            <button class="btn btn-primary" onclick="sendRequest()" id="verify">Kirim surel verifikasi!</button>
        </div>
        <div class="pt-4" id="message"></div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    let message = document.getElementById('message')

    async function sendRequest() {
        const url = "<?php echo route_to('auth.verify.send') ?>"
        let payload = {
            "id": <?= $id ?>
        }

        message.innerHTML = "<p>Harap tunggu ...</p>"
        await axios.post(url, payload, {
                header: {
                    'Content-Type': "application/json",
                    'Accept': "application/json"
                }
            }).then((r) => {
                onSuccess("Email telah di kirim")
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
                        case 5001: {
                            onError("Tidak dapat mengirim email, harap hubungi admin")
                            return
                        }
                        default: {
                            onError(e.message)
                            return
                        }
                    }
                }
                onError(e.message)
                onError(e)
            });

    }

    function onSuccess(msg) {
        message.innerHTML = `<p class='text-success'>${msg}</p>`
    }

    function onError(msg) {
        message.innerHTML = `<p class='text-danger'>${msg}</p>`
    }
</script>