var mongoose = require("mongoose");

var customerSchema = new mongoose.Schema(
  {
    CustomerID: String,
    CompanyName: String,
    ContactName: String,
    ContactTitle: String,
    Address: String,
    City: String,
    Region: String,
    PostalCode: String,
    Country: String,
    Phone: String,
    Fax: String
  },
  {
    timestamps: true
  }
);

module.exports = mongoose.model("Customer", customerSchema);
