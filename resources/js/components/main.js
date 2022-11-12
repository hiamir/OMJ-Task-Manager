// document.addEventListener('alpine:init', function () {
//     Alpine.data('Main', ($wire, data) => ({
//         darkMode: data.darkMode
//     }));
//
// });

export function Main(data) {
    return {
        darkMode: data.darkMode,
        isSidebarOpen: false,
        toast:{'show':false,'type':'normal','message':'Some message!'},
        isFirstModelButtonClicked: false,

        init() {
            this.darkMode = true;
            this.eventToListen();
            Alpine.effect(() => {
                console.log(this.isFirstModelButtonClicked);
            });
        },

        toastNotification() {
            if(this.toast.show === true){
                setTimeout(() => {
                    this.toast.show = false
                }, 5000)
            }
        },

        eventToListen() {

            // First Model
            window.addEventListener('FirstModel', event => {
                if (event.detail.show === false) {
                    this.isFirstModelButtonClicked = false
                }
            });

            // Toast
            window.addEventListener('Toast', event => {
                if (event.detail.show === true) {
                    this.toast.show=true
                    this.toast.type=event.detail.type;
                    this.toast.message=event.detail.message;
                    this.toastNotification();
                }
            });
        }
    }
}

export default Main


