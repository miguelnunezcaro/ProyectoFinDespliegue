let paso=1;const pasoInicial=1,pasoFinal=3,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaAnterior(),paginaSiguiente(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t="#paso"+paso;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",()=>{paso<=1||(paso--,botonesPaginador())})}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",()=>{paso>=3||(paso++,botonesPaginador())})}async function consultarAPI(){try{const e=location.origin+"/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:a}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=o;const r=document.createElement("P");r.classList.add("precio-servicio"),r.textContent=a+"€";const c=document.createElement("DIV");c.classList.add("servicio"),c.dataset.idServicio=t,c.onclick=()=>{seleccionarServicio(e)},c.appendChild(n),c.appendChild(r),document.querySelector("#servicios").appendChild(c)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some(e=>e.id===t)?(cita.servicios=o.filter(e=>e.id!==t),a.classList.remove("seleccionado")):o.length<3?(a.classList.add("seleccionado"),cita.servicios=[...o,e]):(console.log("hola"),mostrarAlerta("Solo puedes seleccionar un máximo de tres servicios.","error",".listadoServicios"))}function idCliente(){cita.id=document.querySelector("#id").value}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",e=>{const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Sábados y domingos no permitidos","error",".formulario")):cita.fecha=e.target.value})}function seleccionarHora(e){document.querySelector("#hora").addEventListener("input",e=>{const t=e.target.value,o=t.split(":")[0],a=t.split(":")[1];o<8||o>21||"00"!==a?(e.target.value="",mostrarAlerta("Las citas solo se pueden programar en punto y el horario es de 8:00AM a 21:00PM","error",".formulario")):cita.hora=e.target.value})}function mostrarAlerta(e,t,o,a=!0){const n=document.querySelector(".alerta");n&&n.remove();const r=document.createElement("DIV");r.textContent=e,r.classList.add("alerta"),r.classList.add(t);document.querySelector(o).appendChild(r),a&&setTimeout(()=>{r.remove()},2e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(e.innerHTML="";e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de servicios, fecha u hora","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:a,servicios:n}=cita,r=document.createElement("H3");r.textContent="Resumen de Servicios",r.classList.add("descripcionPag"),e.appendChild(r),n.forEach(t=>{const{id:o,precio:a,nombre:n}=t,r=document.createElement("DIV");r.classList.add("contenedor-servicio");const c=document.createElement("P");c.textContent=n;const i=document.createElement("P");i.innerHTML=`<span>Precio: </span> ${a}€`,r.appendChild(c),r.appendChild(i),e.appendChild(r)});const c=n.map(e=>e.precio).reduce((e,t)=>e+parseFloat(t),0),i=document.createElement("P");i.innerHTML=`<span>Precio Total:</span> ${c.toFixed(2)}€`,e.appendChild(i);const s=document.createElement("H3");s.textContent="Resumen de Cita",s.classList.add("descripcionPag"),e.appendChild(s);const d=document.createElement("P");d.innerHTML="<span>Nombre:</span> "+t;const l=new Date(o),u=l.getMonth(),m=l.getDate(),p=l.getFullYear(),v=new Date(Date.UTC(p,u,m)).toLocaleDateString("es-ES",{weekday:"long",year:"numeric",month:"long",day:"numeric"}).replace(/\b(?!(?:d|D)e)\w/g,e=>e.toUpperCase()).replace(/De/g,"de"),h=document.createElement("P");h.innerHTML="<span>Fecha:</span> "+v;const g=document.createElement("P");g.innerHTML="<span>Hora:</span> "+a;const f=document.createElement("BUTTON");f.classList.add("boton"),f.textContent="Reservar Cita",f.onclick=async function(){const{nombre:e,fecha:t,hora:o,servicios:a,id:n}=cita,r=a.map(e=>e.id),c=new FormData;c.append("fecha",t),c.append("hora",o),c.append("usuarioId",n),c.append("servicios",r);try{const e=location.origin+"/api/citas",t=await fetch(e,{method:"POST",body:c}),o=await t.json();console.log(o.resultado),o.resultado&&Swal.fire({icon:"success",title:"Cita Creada",text:"Tu cita ha sido creada correctamente"}).then(()=>{window.location.reload()})}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita"})}},e.appendChild(d),e.appendChild(h),e.appendChild(g),e.appendChild(f)}document.addEventListener("DOMContentLoaded",()=>{iniciarApp()});