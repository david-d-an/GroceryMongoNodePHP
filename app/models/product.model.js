var mongoose = require("mongoose");

var productSchema = new mongoose.Schema(
  {
    ProductID: String,
    ProductName: String,
    SupplierID: String,
    CategoryID: String,
    QuantityPerUnit: String,
    UnitPrice: Number,
    UnitsInStock: Number,
    UnitsOnOrder: Number,
    ReorderLevel: Number,
    Discontinued: Boolean
  },
  {
    timestamps: true
  }
);

module.exports = mongoose.model("Product", productSchema);


