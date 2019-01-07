describe("Cart", function(){
  var cart, product;

  beforeEach(function(){
    cart = new Cart();
    product = { id: 1, name: "GTA5", price: 100, count: 1 };
  });

  it("can add product", function(){
    cart.addProduct(product);
    expect(cart.getProduct(product.id)).toBe(product);
    expect(cart.items.length).toBe(1);
  });

  it("can remove product", function(){
    cart.addProduct(product);
    cart.removeProduct(product.id);
    expect(cart.items.length).toBe(0);
    expect(cart.getProduct(product.id)).not.toBeDefined();
  });

  it("can calculate after adding products", function(){
    cart.addProduct(product);
    cart.addProduct(product);
    cart.addProduct(product);

    cart.calculate();

    expect(cart.itemsCount).toBe(3);
    expect(cart.totalAmount).toBe(300);
    expect(cart.items.length).toBe(1);
  });
});

describe("Cart async add product", function(){
  var cart;

  beforeEach(function(done){
    cart = new Cart();
    cart.onAdd(null, 1, done);
  });

  it("can async add product", function(done){
    expect(cart.getProduct(1).id).toBe(1);
    expect(cart.items.length).toBe(1);
    done();
  });
});


describe("Cart async clear cart", function(){
  var cart, product;

  beforeEach(function(done){
    cart = new Cart();
    product = { id: 1, name: "GTA5", price: 100, count: 1 };
    cart.addProduct(product);
    cart.addProduct(product);
    cart.calculate();
    cart.clearCart(done);
  });

  it("can async clear cart", function(done){
    expect(cart.itemsCount).toBe(0);
    expect(cart.totalAmount).toBe(0);
    expect(cart.items.length).toBe(0);
    done();
  });
});