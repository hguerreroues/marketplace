function cifrarMD5()
{
    var inputContra = document.getElementById("password");
    inputContra.value= CryptoJS.MD5(inputContra.value);
}