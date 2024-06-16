import React from 'react';
import { Modal, Form, Input, Button } from 'antd';

const AddCustomer = ({ isVisible, onClose, onAddCustomer }) => {
  const [form] = Form.useForm();

  const handleAddSubmit = (values) => {
    console.log('Form values:', values);
    // Add the new customer
    onAddCustomer(values);
    // Close the modal
    onClose();
    // Clear the form
    form.resetFields();
  };

  return (
    <Modal
      title="Add New Customer"
      visible={isVisible}
      onCancel={onClose}
      onOk={() => form.submit()}
    >
      <Form
        form={form}
        layout="vertical"
        onFinish={handleAddSubmit}
      >
        <Form.Item
          name="customerName"
          label="Enter customer name"
          rules={[{ required: true, message: 'Please input the customer name!' }]}
        >
          <Input />
        </Form.Item>
        <Form.Item
          name="contactInfo"
          label="Enter contact info"
          rules={[{ required: true, message: 'Please input the contact info!' }]}
        >
          <Input />
        </Form.Item>
      </Form>
    </Modal>
  );
};

export default AddCustomer;
