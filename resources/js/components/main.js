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
                (event.detail.show === true) ?  this.isFirstModelButtonClicked = true : this.isFirstModelButtonClicked = false;
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


