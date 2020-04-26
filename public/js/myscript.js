const flashData = $('.flash-data').data('flashdata');
if(flashData){
    Swal.fire(
        '',
        '' + flashData,
        'success'
    )
}

// deleted button
$('.deleted-button').on('click', function(e){
    e.preventDefault();
    // kalo pake tag a
    // const href = $(this).attr('href')
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            // kalo pake tag a
            // document.location.action = action;
            $(e.target).closest('form').submit();
        }
    })
});