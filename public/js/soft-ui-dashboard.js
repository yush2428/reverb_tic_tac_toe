// Soft UI Dashboard functionality

var soft = {
    showSwal: function(type) {
        if (type === 'success-message') {
            Swal.fire({
                title: 'Good job!',
                text: 'You clicked the button!',
                icon: 'success',
                customClass: {
                    confirmButton: 'inline-block px-6 py-3 mb-0 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25'
                },
                buttonsStyling: false
            });
        }
    }
}
