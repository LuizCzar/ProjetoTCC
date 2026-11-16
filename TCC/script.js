function getUsuario(nome){

    fetch("listar_usuarios.php", 
    {
        method: "POST",
        headers: { "Content-Type": "application/json"},
        body: JSON.stringify({  nome : nome })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao carregar o arquivo: ' 
                + response.statusText);
        }
        return response.json(); //text, blob ou json...
    })
    .then(data => {
        console.log( data );
        
        var lista = document.getElementById("listar_usuario");
        lista.innerHTML = ""; 
         
        document.getElementById("pagination").innerHTML = "";
        for( var i = 0; i < data.length; i++){
            num_usu = 8;
           if( i % num_usu == 0){
             divc = document.createElement("div");
             divc.setAttribute("id", "listausu-" + i/num_usu);
             divc.setAttribute("class", "listausuario");
             if(i/num_usu != 0 )
                divc.style.display = "none";
             lista.appendChild( divc );

            span_pag = document.createElement("span"); 
            span_pag.innerHTML = (i/num_usu) + 1;
            span_pag.setAttribute("ref", i/num_usu);
            document.getElementById("pagination").appendChild( span_pag );
            if(i/num_usu == 0 )
                span_pag.classList.add("active");

            span_pag.addEventListener("click", function(){
                document.getElementsByClassName("active")[0].classList.remove("active");

                this.classList.add("active");

                pages = document.getElementsByClassName("listausuario");
                for( var j = 0; j < pages.length; j++)
                    pages[j].style.display = "none";

                page = document.getElementById("listausu-" + this.getAttribute("ref"));
                page.style.display = "grid";

            });

           }

            divc.innerHTML += `

                <div class="card">
                    
                    <img 
                        src="${data[i].foto}"
                        class="img"
                        alt="Foto de ${data[i].nome}"
                    >
                    <h3>
                        ${data[i].nome}<br>
                        <small>${data[i].curso + " - " + data[i].turma}</small>
                    </h3>

                    <button onclick="obterDados(${data[i].id_usuario})">Ver Perfil</button>
                </div>
            `;
        }
        return data;
    })
    .catch(error => {
        console.log(error);
    });
}

function getTodosDados(id_usuario){
    
    fetch("pegar_dados.php",
        {
            method: "POST",
        headers: { "Content-Type": "application/json"},
        body: JSON.stringify({ id_usuario : id_usuario })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao carregar o arquivo: ' 
                + response.statusText);
        }
        return response.json(); //text, blob ou json...
    }) 
    .then(data => {
        console.log( data );
        
        if (data.length === 0) {
            alert("Usuário não encontrado");
            return;
        }
        
        document.getElementById("avatar").innerHTML =
        `<img src="${data[0].foto}" alt="Foto de ${data[0].nome}">`;
        
        document.getElementById("nome").textContent = data[0].nome;
        document.getElementById("bio").textContent = data[0].bio;
        document.getElementById("turma").textContent = data[0].curso + " - " + data[0].turma;
        document.getElementById("turno").textContent = data[0].turno;
        
        var git = data[0].github || "Não informado";
        var gmail = data[0].gmail || "Não informado";
        var insta = data[0].instagram || "Não informado";
        var whats = data[0].whatsapp || "Não informado";
        var face = data[0].facebook || "Não informado";
        
        document.getElementById("git").textContent = git;
        document.getElementById("gmail").textContent = gmail;
        document.getElementById("insta").textContent = insta;
        document.getElementById("whats").textContent = whats;
        document.getElementById("face").textContent = face;
    })
    .catch(err => console.error(err));

     fetch("pegar_projetos_users.php",
        {
            method: "POST",
        headers: { "Content-Type": "application/json"},
        body: JSON.stringify({ id_usuario : id_usuario })
    })
    .then(res => res.json())
    .then(data => {
        
        var pjt;
        pjt = document.getElementById("project-grid")
        if (data.length === 0) {
            pjt.innerHTML = `<div class="addpjt" >        
                    <p>Nenhum<p>
                    <p>projeto adicionado</p>
                    </div> `;
            return;
        }
        
        for( var i = 0; i < data.length; i++){
            pjt.innerHTML = `
                <div class="project-card">        
                    <h4>${data[i].nome}</h4>
                    <span class="hp">Habilidade principal: ${data[i].habil}</span>    
                    <p>${data[i].descricao}</p>
                    <a href="${data[i].link}"><button class="vm">VEJA MAIS</button></a>
                </div>` + pjt.innerHTML;
        }
        
    })
    .catch(error => console.log(error));

    fetch("habilidade_users.php",
        {
            method: "POST",
        headers: { "Content-Type": "application/json"},
        body: JSON.stringify({ id_usuario : id_usuario })
    })
    .then(res => res.json())
    .then(data => {
        
        //total funcionando
        var total = 0;
        for(var i = 0; i < data.length; i++){
            total += Number(data[i].quantidade);
        }
        console.log(total);
        var habil = document.getElementById("habil");
        habil.innerHTML = "";
        for(var i = 0; i < data.length; i++){
            var quant = Number(data[i].quantidade);
            var porc = (quant * 100 / total).toFixed(1);
            console.log(porc);

            habil.innerHTML += `<label>${data[i].nome} (${porc}%)</label>
                <div class="bar"><div style="width: ${porc}%;"></div></div>`;
        }
        

    })
    .catch(err => console.error(err));
}

function obterDados(id_usuario ){
    window.location = 'obterdados.html?user='+id_usuario;
}

/* AREA REFERENTE AO PERFIL DO USUARIO LOGADO */
function showPerfil() {
    
    fetch("meu_perfil.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

        if (data.length === 0) {
            alert("Usuário não encontrado ");
            return;
        }

        document.getElementById("avatar").innerHTML =
            `<img src="${data[0].foto}" alt="Foto de ${data[0].nome}">`;

        document.getElementById("nome").textContent = data[0].nome;
        document.getElementById("bio").textContent = data[0].bio;
        document.getElementById("turma").textContent = data[0].curso + " - " + data[0].turma;
        document.getElementById("turno").textContent = data[0].turno;

        var git = data[0].github || "Não informado";
        var gmail = data[0].gmail || "Não informado";
        var insta = data[0].instagram || "Não informado";
        var whats = data[0].whatsapp || "Não informado";
        var face = data[0].facebook || "Não informado";

        document.getElementById("git").textContent = git;
        document.getElementById("gmail").textContent = gmail;
        document.getElementById("insta").textContent = insta;
        document.getElementById("whats").textContent = whats;
        document.getElementById("face").textContent = face;
    })
    .catch(err => console.error(err));

    fetch("pegar_projetos.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);

        var pjt = document.getElementById("project-grid")
        pjt.innerHTML = "";

        if (data.length === 0) {
            pjt.innerHTML = `<div class="addpjt" >        
                    <a href="add_projeto.html" >+</a> 
                    <p>Adicionar projeto</p>
                    </div> `;
            return;
        }
        

        for( var i = 0; i < data.length; i++){          
            pjt.innerHTML = `
                <div class="project-card"> 
                    <div>
                        <button class="edtProjeto" data-id="${data[i].id_projeto}"><img src="img/social/caneta.png" alt="imagem de uma lixeira vermelha"></button>
                        <button class="excProjeto" data-id="${data[i].id_projeto}"><img src="img/social/excluir.png" alt="imagem de uma lixeira vermelha"></button> 
                    </div>      
                    <h4>${data[i].nome}</h4>
                    <span class="hp">Habilidade principal: ${data[i].habil}</span>    
                    <p>${data[i].descricao}</p>
                    <a href="${data[i].link}"><button class="vm">VEJA MAIS</button></a>
                </div>` + pjt.innerHTML;

            if(i+1 == data.length){
                pjt.innerHTML = `<div class="addpjt" >        
                    <a href="add_projeto.html" >+</a> 
                    <p>Adicionar projeto</p>
                    </div> ` + pjt.innerHTML;}
        }
   
    })
    .catch(err => console.error(err));

    fetch("minhas_habilidades.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data.length === 0) {
            return;
        }
        //total funcionando
        var total = 0;
        for(var i = 0; i < data.length; i++){
            total += Number(data[i].quantidade);
        }

        var habil = document.getElementById("habil");
        habil.innerHTML = "";
        for(var i = 0; i < data.length; i++){
            var quant = Number(data[i].quantidade);
            var porc = (quant * 100 / total).toFixed(1);
            console.log(porc);

            habil.innerHTML += `<label>${data[i].nome} (${porc}%)</label>
                <div class="bar"><div style="width: ${porc}%;"></div></div>`;
        }
        

    })
    .catch(err => console.error(err));
}

//PEGAR OS CURSOS PRO CADASTRO E ADD_PROJETOS
function listarCurso(){
    fetch("listar_curso.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

        if (data.length === 0) {
            alert("Cursos não encontrados");
            return;
        }
        var curso = document.getElementById("curso");

        curso.innerHTML = "";
        for( var i = 0; i < data.length; i++){
            curso.innerHTML += `
                <option value="${data[i].id_curso}">${data[i].nome}</option>
            `;
            if(i+1 == data.length){
                curso.innerHTML = `<option value="">Não informado</option>` +
                curso.innerHTML;
            }
        }

    console.log(data)
    })
    .catch(err => console.error(err));
};

//PEGAR HABILIDADE E TIME PARA O ADD_PROJETOS
function getSelect(){
    fetch("listar_habilidade.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

        if (data.length === 0) {
            alert("Habilidades não encontradas");
            return;
        }
        var habil = document.getElementById("habil");

        habil.innerHTML = "";
        for( var i = 0; i < data.length; i++){
            habil.innerHTML += `
                <option value="${data[i].id_habilidade}">${data[i].nome}</option>
            `;
            if(i+1 == data.length){
                habil.innerHTML = `<option value="">Não informado</option>` +
                habil.innerHTML;
            }
        }

    console.log(data)
    })
    .catch(err => console.error(err));

    fetch("listar_time.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

    if (data.length === 0) {
        return;
    }
        var time = document.getElementById("time");
        time.innerHTML = "";
        for( var i = 0; i < data.length; i++){
            time.innerHTML += `
                <option value="${data[i].id}">${data[i].nome}</option>
            `;

            if(i+1 == data.length){
                time.innerHTML = `<option value="">Não informado</option>` + time.innerHTML;
            }

        }
        document.getElementById("voltar-perfil").innerHTML =`
        <a href="meu_perfil"> <img src="${data[0].foto}"> </a>`; 

    console.log(data)
    })
    .catch(err => console.error(err));

};

function excluirTime(id_time){
    fetch("apg_time.php", {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({  id_time : id_time })
    })
    .catch(err => console.error(err));
}

function nomeTime(id_time){
    fetch("listar_time.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {
        for(var i = 0; i < data.length; i++){
            if(data[i].id == id_time){
                document.getElementById("nomeTime").textContent = data[i].nome
            }
        }
    })
    .catch(err => console.error(err));
}

//APAGAR PROJETO
function apgProjeto(id){
    fetch("apg_projeto.php", {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({  id : Number(id) })
    })
    .catch(err => console.error(err));
    showPerfil();
}

//EDITAR PROJETO
function infoProjeto(id){
    fetch("listar_habilidade.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

    if (data.length === 0) {
        alert("Habilidades não encontrada");
        return;
    }

        for( var i = 0; i < data.length; i++){
            document.getElementById("habil").innerHTML += `
                <option value="${data[i].id_habilidade}">${data[i].nome}</option>
            `;
        }

    console.log(data)
    })
    .catch(err => console.error(err));

    fetch("listar_time.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

    if (data.length === 0) {
        alert("Time não encontrado");
        return;
    }

        for( var i = 0; i < data.length; i++){
            document.getElementById("time").innerHTML += `
                <option value="${data[i].id}">${data[i].nome}</option>
            `;
        }
        document.getElementById("voltar-perfil").innerHTML =`
        <a href="meu_perfil"> <img src="${data[0].foto}"> </a>`; 

    console.log(data)
    })
    .catch(err => console.error(err));

    fetch("infoProjeto.php", {
            method: "POST",
            headers: { "Content-Type": "application/json"},
            body: JSON.stringify({ id : id })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById("nome").value = data[0].nome;
            document.getElementById("link").value = data[0].link;
            document.getElementById("desc").value = data[0].descricao;
            document.getElementById("habil").value = data[0].habil;
            document.getElementById("time").value = data[0].id_time;
            document.getElementById("id_pjt").value = id;
            
        })
        .catch(err => console.error(err));
};

function nomePjt(id){
    fetch("infoProjeto.php", {
            method: "POST",
            headers: { "Content-Type": "application/json"},
            body: JSON.stringify({ id : id })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById("nomePjt").textContent = data[0].nome;
        })
        .catch(err => console.error(err));
}

/* APENAS PARA MOSTRAR UM BOTAO DE VOLTAR PRO SEU PERFIL COMO IMAGEM */
function getFotoVoltar(){
    fetch("meu_perfil.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

    if (data.length === 0) {
        alert("Usuário não encontrado");
        return;
    }
        document.getElementById("voltar-perfil").innerHTML =`
        <a href="meu_perfil"> <img src="${data[0].foto}"> </a>`; 
    })
    .catch(err => console.error(err));
}

/* APENAS PARA MOSTRAR A IMAGEM NO EDTIAR PERFIL*/
document.getElementById('foto').addEventListener('change', function () {
    const file = this.files[0];

    if (!file) return;

    if (!file.type.startsWith('image/')) {
        alert('Selecione uma imagem');
        this.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        const img = document.getElementById('preview');
        img.src = e.target.result;
        img.style.display = 'block';
    };

    reader.readAsDataURL(file);
});


// PARA VERIFICAR NA PAGINA INDEX SE MOSTA O LOGIN/CADASTRO OU O BOTÃO DE PERFIL    
function verificarLogin(){
    var foto;

    fetch("meu_perfil.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

         foto = data[0].foto;
    })
    .catch(err => console.error(err));

    fetch("verificar.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {

        if(data.logado){
            console.log("Usuário logado"); 
            document.getElementById("logar").style.display = "none";
            document.getElementById("perfil").innerHTML = `<a href="meu_perfil.html"><img class="perfil" src="${foto}" alt="imagem do perfil do usuario"></a>`;

        } else {
            console.log("Usuário NÃO logado");
        }
    })
    .catch(err => console.error(err));
}

/* REFERENTE A PAGINA DE ADD TIME */
/* A varialvel 'lista' esta no 'add_time' */
function listaEmail(){
    fetch("listar_email.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {
    if (data.length === 0) {
        alert("erro na busca");
        return;
    }
        for( var i = 0; i < data.length; i++){
            document.getElementById("usuarios").innerHTML += `
                <option value="${data[i].email}">
            `;
        }
         console.log(data);
    })
    .catch(err => console.error(err));

    fetch("meu_perfil.php", {
        method: "POST",
        credentials: "same-origin"
    })
    .then(res => res.json())
    .then(data => {
    if (data.length === 0) {
        alert("erro na busca");
        return;
    }
        document.getElementById("apelido").textContent = data[0].nome;

    })
    .catch(err => console.error(err));
}

function addLista(email){

    fetch("pegar_email.php", {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({  email : email })
    })
    .then(res => res.json())
    .then(data => {

    if (data.length === 0) {
        alert("Usuário não encontrado");
        return;
    }
        let id = Number(data[0].id_usuario);
        if(!lista.includes(id)){
            lista.push(id);
            var mem = document.getElementById("membro-conf")

            var balao = document.createElement("div");
             balao.setAttribute("id", data[0].id_usuario);
             balao.setAttribute("class", "balao");
             mem.appendChild(balao);

            var nome = document.createElement("span");
             nome.innerHTML = data[0].nome;
             balao.appendChild(nome);

            var botao = document.createElement("button")
             botao.setAttribute("class", "remover" );
             botao.setAttribute("data-id", data[0].id_usuario);
             botao.setAttribute("type", "button");
             botao.innerHTML = `x`;
             balao.appendChild( botao );
        }
        
    })
    .catch(err => console.error(err));
} 

function mandaLista(lista, nome){
    fetch("add_time.php", {
        method: "POST",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({  lista : lista, nome : nome})
    });
    window.location = 'add_projeto.html';
};

