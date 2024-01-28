window.onload = function(){
    document.getElementById("downloadButton")
    .addEventListener("click",()=>{
        const inv = this.document.getElementById("bill");
        console.log(bill);
        console.log(window);
        html2pdf().from(bill).save();
    })
}