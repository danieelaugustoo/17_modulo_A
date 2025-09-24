function ativarContraste() {
  document.body.classList.toggle("alto-contraste");
  const botao = document.getElementById("alto-contraste");
  if (document.body.classList.contains("alto-contraste")) {
    botao.innerHTML = "Desativar alto contraste";
  } else {
    botao.innerText = "Ativar alto contraste";
  }
}
