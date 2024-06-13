import React, { useState } from 'react';
import axios from 'axios';

function AddProduct() {
  const [productType, setProductType] = useState('');
  const [productId, setProductId] = useState('');
  const [productTitle, setProductTitle] = useState('');
  const [pricePerItem, setPricePerItem] = useState('');
  const [selectedImage, setSelectedImage] = useState(null);
  const [progress, setProgress] = useState(0);

  const handleProductTypeChange = (event) => {
    setProductType(event.target.value);
  };

  const handleProductIdChange = (event) => {
    setProductId(event.target.value);
  };

  const handleProductTitleChange = (event) => {
    setProductTitle(event.target.value);
  };

  const handlePricePerItemChange = (event) => {
    setPricePerItem(event.target.value);
  };

  const handleImageChange = (event) => {
    setSelectedImage(event.target.files[0]);
  };

  const handleImageUpload = async (event) => {
    event.preventDefault();
    try {
      const formData = new FormData();
      formData.append('file', selectedImage);
      const response = await axios.post('/upload/file', formData, {
        onUploadProgress: (progressEvent) => {
          const progress = Math.round((100 * progressEvent.loaded) / progressEvent.total);
          setProgress(progress);
        },
      });
      setProgress(0);
      console.log(response);
    } catch (error) {
      console.log(error);
    }
  };

  const handleAddProduct = async (event) => {
    event.preventDefault();
    try {
      const productData = {
        productType,
        productId,
        productTitle,
        pricePerItem,
        image: selectedImage,
      };
      const response = await axios.post('/api/products', productData);
      console.log(response);
      // redirect to product list page
      window.location.href = '/';
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <div>
      <h1>Add Product</h1>
      <form>
        <label>
          Select product type:
          <select value={productType} onChange={handleProductTypeChange}>
            <option value="">Select</option>
            <option value="necklace">Necklace</option>
            <option value="bracelet">Bracelet</option>
            <option value="ring">Ring</option>
            <option value="earings">Earrings</option>
          </select>
        </label>
        <br />
        <label>
          Product ID:
          <input type="text" value={productId} onChange={handleProductIdChange} />
        </label>
        <br />
        <label>
          Product Title:
          <input type="text" value={productTitle} onChange={handleProductTitleChange} />
        </label>
        <br />
        <label>
          Price per Item:
          <input type="number" value={pricePerItem} onChange={handlePricePerItemChange} />
        </label>
        <br />
        <label>
          Image:
          <input type="file" onChange={handleImageChange} />
        </label>
        <br />
        <button type="submit" onClick={handleImageUpload}>
          Upload Image
        </button>
        <br />
        <button onClick={handleAddProduct}>Add Product</button>
        <br />
        <button onClick={() => window.location.href = '/'}>
          Back to Product List
        </button>
      </form>
      {progress > 0 && (
        <div>
          Uploading... {progress}%
        </div>
      )}
    </div>
  );
}

export default AddProduct;