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
});

// var postId = 0;
// var postBodyElement = null;
//
// $('.like').on('click', function (event) {
//     event.preventDefault();
//     postId = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['id'];
//     var isLike = event.target.previousElementSibling == null;
//     $.ajax({
//         method: 'POST',
//         url: urlLike,
//         data: { isLike: isLike, postId: postId, _token: token}
//     })
//     .done(function () {
//         // Something
//     })
//     console.log(postId);
// });
