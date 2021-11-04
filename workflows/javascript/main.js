let carts = document.querySelectorAll('.add-cart');

let products = [
    {
        name: 'T-Shirt',
        tag: 'tshirt',
        price: 15,
        incart: 0
    },
    {
        name: 'Shirt',
        tag: 'shirt',
        price: 20,
        incart: 0
    },
    {
        name: 'Pants',
        tag: 'pants',
        price: 10,
        incart: 0
    }
]

for (let i=0; i > carts.length; i++) {
    carts[i].addEventListener('click', () => {
        cartNumbers();
        
    })
}

function onLoadCartNumbers() {
    let productNumbers = localStorage.getItem('cartNumbers');

    if(productNumbers){
        document.querySelector('.cart span').textContent = productNumbers;
    }
}

function cartNumbers() {
    let productNumbers = localStorage.getItem('cartNumbers');

    productNumbers = parseInt(productNumbers);

    if(productNumbers){
        localStorage.setItem('cartNumber', productNumbers + 1);
        document.querySelector('.cart span').textContent = productNumbers + 1;
    } else{
        localStorage.setItem('cartNumber', 1);
        document.querySelector('.cart span').textContent = 1;
    }
}

onLoadCartNumbers();