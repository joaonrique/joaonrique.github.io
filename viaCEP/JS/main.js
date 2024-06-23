function salvarCEP() {
    var cep = document.querySelector("#cep").value;

    fetch("https://viacep.com.br/ws/" + cep + "/json/")
        .then((response) => response.json())
        .then((data) => {
            console.log("Dados retornados da API:", data);
            document.querySelector("#logradouro").value = data.logradouro;
            document.querySelector("#complemento").value = data.complemento;
            document.querySelector("#bairro").value = data.bairro;
            document.querySelector("#localidade").value = data.localidade;
            document.querySelector("#uf").value = data.uf;
            document.querySelector("#ibge").value = data.ibge;
            document.querySelector("#ddd").value = data.ddd;
        })
        .catch((error) => {
            console.error("Erro ao obter dados da API:", error);
        });
}