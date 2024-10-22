function cifrarMD5()
{
    var inputContra = document.getElementById("psw");
    var contra = document.getElementById("password");
    contra.value= CryptoJS.MD5(inputContra.value);
}