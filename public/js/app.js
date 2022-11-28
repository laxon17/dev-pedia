document.addEventListener('DOMContentLoaded', () => {
    const commentForm = document.getElementById('commentForm')
    const formBody = document.getElementById('formBody')
    const errorBox = document.getElementById('errorBox')
    const commentTrigger = document.getElementById('commentTrigger')

    formBody.style.display = 'none'

    commentTrigger.addEventListener('click', () => {
        if(formBody.style.display === 'none') {
            formBody.style.display = 'block'
        } else {
            formBody.style.display = 'none'
        }
    })

    commentForm.addEventListener('submit', async (event) => {
        event.preventDefault()
        let postId = document.querySelector('input[name=post_id]').value
        let token = document.querySelector('input[name=_token]').value
        let commentBody = document.getElementById('commentBody')
        if(commentBody.value === '') {
            errorBox.innerText = 'Provide a valid comment!'
            hideMessage()
            return
        }

        let data = {
            body: commentBody.value,
            post_id: postId
        }

        await postComment(token, data)

        location.reload()
    })
})

async function postComment(token, data) {
    return await fetch('/comments', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': token
        },
        body: JSON.stringify(data)
    })
}

function hideMessage() {
    setTimeout(() => {
        errorBox.innerText = ''
    }, 5000)
}