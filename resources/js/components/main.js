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
         isFirstModelButtonClicked:false,
         init() {
             this.darkMode=true;
             Alpine.effect(() => {
                 console.log( this.isModelButtonClicked);
             });
         }
     }
}

export default Main


