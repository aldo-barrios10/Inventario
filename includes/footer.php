
<script src="../resources/js/all.min.js"></script>
<script src="../resources/js/sweetalert2.all.min.js"></script>
<script src="../resources/js/jquery.min.js"></script>
<script src="../resources/js/dataTables.min.js"></script>
<script src="../resources/js/dataTables.bootstrap5.min.js"></script>
<script src="../resources/footable/js/footable.js"></script>
<script src="../resources/footable/js/footable.min.js"></script>
<script src="../resources/js/tables.js"></script>
<script src="../resources/js/actions.js"></script>
<script src="../resources/js/forms.js"></script>





<script>
function date() {
    var fecha = new Date();
    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1;
    var año = fecha.getFullYear();

    var me = ["Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ];
    document.getElementById("date").innerHTML = 'Hoy es ' + dia + ' de ' + me[mes - 1] + ' del ' + año;
}

document.addEventListener("DOMContentLoaded", date);
</script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
   
   const showNavbar = (toggleId, navId, bodyId, headerId) =>{
   const toggle = document.getElementById(toggleId),
   nav = document.getElementById(navId),
   bodypd = document.getElementById(bodyId),
   headerpd = document.getElementById(headerId)
   
   if(toggle && nav && bodypd && headerpd){
   toggle.addEventListener('click', ()=>{
   nav.classList.toggle('show')
   toggle.classList.toggle('bx-x')
   bodypd.classList.toggle('body-pd')
   headerpd.classList.toggle('body-pd')
   })
   }
   }


   
   showNavbar('header-toggle','nav-bar','body-pd','header')
   
   const linkColor = document.querySelectorAll('.nav_link')
   
   function colorLink(){
   if(linkColor){
   linkColor.forEach(l=> l.classList.remove('active'))
   this.classList.add('active')
   }
   }
   linkColor.forEach(l=> l.addEventListener('click', colorLink))

   });

</script>

