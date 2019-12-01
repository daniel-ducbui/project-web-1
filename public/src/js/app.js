$('.card-body').find('.interaction').find('.edit').on('click', function (event) {
    event.preventDefault();

    var postContent = null;
    // postContent = document.getElementById('user_post_content').parentNode.childNodes[1].textContent;

    // postContent = $('#user_post_content').val();

    postContent = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[1].textContent;
    // var postContent = event.target.node.childNodes[1].textContent;

    $('#post-content').val(postContent);
    console.log(postContent);
    $('#edit-modal').modal();
})
//
// $(document).ready(function () {
//     const privacyOldValue = "{{ old('privacy' }}";
//
//     if (privacyOldValue !== '') {
//         $('#privacy').val('privacyOldValue');
//     }
// });
