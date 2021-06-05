var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

var Messagebox = {
    $axios: null,
    init: function () {
        var that = this;
        that.$axios = axios.create({
            baseURL: window.location.protocol + "//" + window.location.host + "/",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            }
        })
    },

    mute_messagebox: function (value) {
        var that = this;
        that.$axios({
                method: 'post',
                url: '/settings/mute',
                data: {
                    mute: value,
                }
            }).then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    },

    check_device_status: function() {
        var that = this;
        return that.$axios({
            method: 'get',
            url: '/device/status'
        }).then((response) => response.data)
    }
}

var checkbox_mute = document.getElementById('mute-checkbox');
checkbox_mute.addEventListener('change', (event) => {
    value = Number(event.currentTarget.checked);
    Messagebox.mute_messagebox(value);
})
