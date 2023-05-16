function chkDuplicationId() {
    const id = document.getElementById('id');
    const url="/api/user?id="+id.value;
    let apiData=null;
    //API
    fetch(url)
    .then(data=>{
        if (data.status!==200) {
            throw new Error(data.status+' : API Response Error')
        }
        return data.json();})
    .then(apiData=>{
        const idSpan = document.getElementById('errMsgId')
        if (apiData["flg"]==="1") {
            idSpan.innerHTML=apiData["msg"]
        }
        else{
            idSpan.innerHTML="사용가능한 ID입니다"
        }
    })
    .catch(error=>alert(error.message))
    
}