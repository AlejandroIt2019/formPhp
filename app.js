// usuarioN, correoN, mensajeN, btnN
// id  formulario usuario:text1 correo:text2 textarea:text3 btn

const formulario = document.getElementById('formulario')
const usuario = document.getElementById('text1')
const correo = document.getElementById('text2')
const mensaje = document.getElementById('text3')
const btn = document.getElementById('btn')

formulario.addEventListener('submit', (e) => {

    e.preventDefault()

    const data = new FormData(formulario)

    if (!data.get('usuarioN').trim()) {
        campoError(usuario)
        return
    }else {
        Valido(usuario)
    }
    if (!data.get('correoN').trim()) {
        campoError(correo)
        return
    }else {
        Valido(correo)
    }
    if (!data.get('mensajeN').trim()) {
        campoError(mensaje)
        return
    }else {
        Valido(mensaje)
    }

    fetch('formulario.php', {
        method: 'POST',
        body: data
    })
        .then(res => res.json())
        .then(dataPhp => {
            console.log(dataPhp)

            if (dataPhp.error && dataPhp.campo === 'usuario') {
                campoError(usuario)
                return
            }
            Valido(usuario)
            if (dataPhp.error && dataPhp.campo === 'correo') {
                campoError(correo)
                return
            }
            Valido(correo)
            if (dataPhp.error && dataPhp.campo === 'mensaje') {
                campoError(mensaje)
                return
            }
            Valido(mensaje)
            
            if (!dataPhp.error) {
                limpiarFormulario()
                Valido(btn)
            }
            
        })
        .catch(e => console.log(e))

})
//funciones
const campoError = (campo) => {
    campo.classList.add('is-invalid')
    campo.classList.remove('is-valid')
}
const Valido = (campo) => {
    campo.classList.add('is-valid')
    campo.classList.remove('is-invalid')
}

const limpiarFormulario = () => {
    console.log("enviado con exito");
    formulario.reset()
    usuario.classList.remove('is-valid')
    correo.classList.remove('is-valid')
    mensaje.classList.remove('is-valid')
}