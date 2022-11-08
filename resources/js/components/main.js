// document.addEventListener('alpine:init', function () {
//     Alpine.data('Main', ($wire, data) => ({
//         darkMode: data.darkMode
//     }));
//
// });

export function Main(data){
     return{
         darkMode:data.darkMode,
         isSidebarOpen:false,
         init() {
             Alpine.effect(() => {
                 // this.darkMode=true;
                 console.log(this.isSidebarOpen);
             });
         }
     }
}

export default Main


