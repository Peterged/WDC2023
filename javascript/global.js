[].concat(...document.querySelectorAll('[href]')).forEach(ele => {
    ele.addEventListener('click', ({ target }) => {
        if(ele == target){
            let hrefVal = ele.getAttribute('href')
            window.location.href = hrefVal;
        }
    })
    // console.log(ele)
})

