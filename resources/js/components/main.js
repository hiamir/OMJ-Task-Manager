// document.addEventListener('alpine:init', function () {
//     Alpine.data('Main', ($wire, data) => ({
//         darkMode: data.darkMode
//     }));
//
// });

export function Main(){
     return{
         darkMode: localStorage.getItem('dark') === 'true',

         init() {
             Alpine.effect(() => {
                 this.darkMode=true;
                 console.log(this.darkMode);
             });
         }
     }
}

export default Main


