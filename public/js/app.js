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
})

document.addEventListener('DOMContentLoaded', function() {
    const trigger = document.getElementById('modalTrigger')
    const modalWindow = document.getElementById('modal')

    modalWindow.style.display = 'none'

    trigger.addEventListener('click', function() {
        if(modalWindow.style.display === 'none') modalWindow.style.display = 'block'
        else modalWindow.style.display = 'none'
    })

    let reasons = document.querySelectorAll('[name="reason"]')
    const otherReasonField = document.getElementById('otherValue')
    const reportButton = document.getElementById('reportBtn')
    const errorBox = document.getElementById('errorMessage')
    const postId = document.getElementById('post').value
    const _token = document.querySelector('[name="_token"]').value

    reportButton.disabled = true
    reportButton.style.backgroundColor = 'gray'
    otherReasonField.disabled = true
    let finalReason = ''

    reasons.forEach(reason => {
        reason.addEventListener('change', () => {
            reportButton.disabled = false
            reportButton.style.backgroundColor = ''
            finalReason = reason.value
            if(reason.value === 'Other') {
                otherReasonField.disabled = false
                finalReason = otherReasonField.value
            } else {
                otherReasonField.disabled = true
                finalReason = reason.value
            }
        })
    })

    reportButton.addEventListener('click', () => {
        let reportObj = {
            reason: finalReason,
            post_id: postId
        }

        if(finalReason === '') {
            errorBox.innerText = 'Please write something...'
            setTimeout(() => {
                errorBox.innerText = ''
            }, 3000)
        } else {
            fetch('/reports', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': _token
                },
                body: JSON.stringify(reportObj)
            }).then(() => { location.reload() })
        }
    })
})