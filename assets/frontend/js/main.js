

const mentBtn = document.querySelector(".mobile_navbar-menuBtn");

const mobileMenu = document.querySelector(".mobile_navbar-bottom");

mentBtn.addEventListener("click" , ()=>{

    mobileMenu.classList.toggle('active');

})


// Faqs
const faqs = document.querySelectorAll(".faq");

faqs.forEach((faq)=>{
    
    

    const header = faq.querySelector(".question__answer .faq_heading");
    
    const paragraph = faq.querySelector(".question__answer .faq_desc");

    header.addEventListener('click',()=>{
        faqs.forEach((newFaq)=>{

            if(faq !== newFaq){
                newFaq.classList.remove("active")
            }
        })

        faq.classList.toggle("active")

    })

})


// Single Course Content

const allContent = document.querySelectorAll('.content');

allContent.forEach((content)=>{

    const header = content.querySelector(" h5");
    const paragraph = content.querySelector(" ul");

    // console.log(header);
    
    content.addEventListener("click",()=>{
        content.classList.toggle("active");
    })

})