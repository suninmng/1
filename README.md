Resume.js :

import React from 'react';
import './Resume.css';

const Resume = () => {
    return (
        <div className="resume-container">
            <header className="header">
                <h1>V Adithya</h1>
                <p>Student | adithya@gmail.com | 9481973181</p>
            </header>

            <section className="section">
                <h2>Education</h2>
                <p>Masters of Computer Application - XYZ University</p>
                <p>Graduated: 2023</p>
            </section>

            <section className="section">
                <h2>intership</h2>
                <p>Web Developer</p>
                <ul>
                    <li>Created AMZon and FLIPKART E-cpmmerce</li>
                    <li>Helped to Sale on Online Various items</li>
                </ul>
            </section>

            <section className="section">
                <h2>Skills</h2>
                <ul>
                    <li>JavaScript, HTML, CSS</li>
                    <li>python, Express, MongoDB</li>
                    <li>Git, Docker</li>
                </ul>
            </section>
        </div>
    );
};
export default Resume;

Resume.css :

.resume-container{
    font-family: Arial,sans-serif;
    margin: 20px auto;
    padding: 20px;
    max-width: 600px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h1 {
    margin: 0;
    font-size: 24px;
}

.header p {
    margin: 5px 0;
    color: #555;
}

.section {
    margin-bottom: 20px;
}

.section h2 {
    font-size: 20px;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
    margin-bottom: 10px;
}

.section ul {
    padding-left: 20px;
}

.section ul li {
    margin-bottom: 5px;
}

App.js :

import React from 'react'; 
import Resume from './Resume';

function App() {
    return (
        <div>
            <Resume />
        </div>
    );
}
export default App;

App.js:

import React, {useState} from 'react';
import StudentForm from './Component/StudentForm';
import StudentList from './Component/StudentList';

const App=()=>{
  const [students,setStudents]=useState([]);
  const addStudent=(student)=>setStudents([...students,student]);

  return(
    <div>
      <h1>Student Registartion Portal</h1>
      <StudentForm addStudent={addStudent} />
      <StudentList students={students} />
    </div>
  );
};

export default App;

StudentForm.js :

import React, {useState} from 'react';
const StudentForm=({addStudent})=>{
    const [formData, setFormData] = useState({ name: '', email: '', course: '' });

                                                                             
    const handleChange = (e) => {
        setFormData({
          ...formData,
          [e.target.name]: e.target.value,
        });
      };
      


    const handleSubmit = (e) => {
        e.preventDefault();
        if (Object.values(formData).every(val => val)) {
            addStudent(formData);
            setFormData({ name: '', email: '', course: '' });
        }
    };
    return (
        <form onSubmit={handleSubmit}>
            {['name','email','course'].map((field)=>(
                <div key={field}>
                    <label>{field.charAt(0).toUpperCase()+field.slice(1)};</label>
                    <input type={field==='email'?'email':'text'} 
                    name={field}
                    value={formData[field]}
                    onChange={handleChange}/>
                </div>
            ))}
            <button type="submit">Register</button>
        </form>
    );
};

export default StudentForm;

StudentList.js :

import React from 'react';

const StudentList = ({ students }) => (
    <div>
        <h2>Registered Students</h2>
        {students.length ? (
            students.map((student, index) => (
                <div key={index}>
                    <h3>{student.name}</h3>
                    <p>Email: {student.email}</p>
                    <p>Course: {student.course}</p>
                </div>
            ))
        ) : (
            <p>No Students Registered yet.</p>
        )}
    </div>
);

export default StudentList;

App.js:
import React, { useEffect, useState } from "react";
import axios from "axios";

function App() {
  const [employees, setEmployees] = useState([]);
  const [newEmployee, setNewEmployee] = useState({ name: "", position: "" });

  useEffect(() => {
    fetchEmployees();
  }, []);

  const fetchEmployees = async () => {
    const res = await axios.get("http://localhost:5001/employees");
    setEmployees(res.data);
  };

  const addEmployee = async () => {
    await axios.post("http://localhost:5001/employees", newEmployee);
    setNewEmployee({ name: "", position: "" });
    fetchEmployees();
  };

  const deleteEmployee = async (id) => {
    await axios.delete(`http://localhost:5001/employees/${id}`);
    fetchEmployees();
  };

  return (
    <div>
      <h2>Employee Management</h2>
      <input
        placeholder="Name"
        value={newEmployee.name}
        onChange={(e) => setNewEmployee({ ...newEmployee, name: e.target.value })}
      />
      <input
        placeholder="Position"
        value={newEmployee.position}
        onChange={(e) => setNewEmployee({ ...newEmployee, position: e.target.value })}
      />
      <button onClick={addEmployee}>Add Employee</button>
      <ul>
        {employees.map(emp => (
          <li key={emp.id}>
            {emp.name} - {emp.position} 
            <button onClick={() => deleteEmployee(emp.id)}>Delete</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default App;

Server.js:
const express = require("express");
const fs = require("fs");
const cors = require("cors");

const app = express();
app.use(express.json());
app.use(cors());

const file = "employees.json";

// Read Employees
app.get("/employees", (req, res) => {
    const data = JSON.parse(fs.readFileSync(file));
    res.json(data);
});

// Add Employee
app.post("/employees", (req, res) => {
    const data = JSON.parse(fs.readFileSync(file));
    const newEmployee = { id: Date.now(), ...req.body };
    data.push(newEmployee);
    fs.writeFileSync(file, JSON.stringify(data, null, 2));
    res.json(newEmployee);
});

// Delete Employee
app.delete("/employees/:id", (req, res) => {
    let data = JSON.parse(fs.readFileSync(file));
    data = data.filter(emp => emp.id != req.params.id);
    fs.writeFileSync(file, JSON.stringify(data, null, 2));
    res.json({ message: "Employee deleted" });
});

app.listen(5001, () => console.log("Server running on port 5000"));

Server.js:
const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

const app = express();
app.use(express.json());
app.use(cors());

// MongoDB Connection (Fixed deprecated options)
mongoose.connect('mongodb://127.0.0.1:27017/inventory')
  .then(() => console.log("Connected to MongoDB"))
  .catch((err) => console.error("Failed to connect to MongoDB:", err));

// Define Mongoose Schema and Model
const itemSchema = new mongoose.Schema({
  name: {
    type: String,
    required: true,
  },
  quantity: {
    type: Number,
    required: true,
    min: [0, "Quantity cannot be negative"],
  },
});

const Item = mongoose.model("Item", itemSchema);

// Get all items
app.get("/items", async (req, res) => {
  try {
    const items = await Item.find();
    res.json(items);
  } catch (error) {
    res.status(500).json({ error: "Failed to fetch items" });
  }
});

// Add new item
app.post("/items", async (req, res) => {
  try {
    const newItem = new Item(req.body);
    await newItem.save();
    res.status(201).json(newItem);
  } catch (error) {
    res.status(400).json({ error: "Failed to add item" });
  }
});

// Update quantity
app.put("/items/:id", async (req, res) => {
  const { id } = req.params;
  const { quantity } = req.body;

  try {
    const updatedItem = await Item.findByIdAndUpdate(
      id,
      { quantity },
      { new: true, runValidators: true }
    );
    if (!updatedItem) {
      return res.status(404).json({ error: "Item not found" });
    }
    res.json(updatedItem);
  } catch (error) {
    res.status(400).json({ error: "Failed to update item" });
  }
});

// Delete item
app.delete("/items/:id", async (req, res) => {
  try {
    const deletedItem = await Item.findByIdAndDelete(req.params.id);
    if (!deletedItem) {
      return res.status(404).json({ error: "Item not found" });
    }
    res.json({ message: "Item deleted successfully" });
  } catch (error) {
    res.status(500).json({ error: "Failed to delete item" });
  }
});

// Start server
app.listen(5000, () => console.log("Server running on port 5000"));

app.js:
import React, { useState, useEffect } from "react";
import axios from "axios";

function App() {
    const [items, setItems] = useState([]);
    const [name, setName] = useState("");
    const [quantity, setQuantity] = useState("");

    // Fetch items from backend
    useEffect(() => {
        fetchItems();
    }, []);

    const fetchItems = async () => {
        try {
            const res = await axios.get("http://localhost:5000/items");
            setItems(res.data);
        } catch (error) {
            console.error("Error fetching items:", error);
        }
    };

    // Add new item
    const addItem = async () => {
        if (!name || !quantity) return alert("Please enter item name and quantity!");
        try {
            const res = await axios.post("http://localhost:5000/items", { name, quantity });
            setItems([...items, res.data]); // Add new item to the list
            setName("");
            setQuantity("");
        } catch (error) {
            console.error("Error adding item:", error);
        }
    };

    // Update quantity
    const updateQuantity = async (id) => {
        const newQuantity = prompt("Enter new quantity:");
        if (!newQuantity || isNaN(newQuantity)) return alert("Invalid quantity!");

        try {
            await axios.put(`http://localhost:5000/items/${id}`, { quantity: newQuantity });
            setItems(items.map(item => item._id === id ? { ...item, quantity: newQuantity } : item));
        } catch (error) {
            console.error("Error updating quantity:", error);
        }
    };

    // Delete item
    const deleteItem = async (id) => {
        if (!window.confirm("Are you sure you want to delete this item?")) return;

        try {
            await axios.delete(`http://localhost:5000/items/${id}`);
            setItems(items.filter(item => item._id !== id)); // Remove item from the list
        } catch (error) {
            console.error("Error deleting item:", error);
        }
    };

    return (
        <div>
            <h1>Inventory Management</h1>
            <input
                type="text"
                placeholder="Item Name"
                value={name}
                onChange={(e) => setName(e.target.value)}
            />
            <input
                type="number"
                placeholder="Quantity"
                value={quantity}
                onChange={(e) => setQuantity(e.target.value)}
            />
            <button onClick={addItem}>Add Item</button>

            <ul>
                {items.map((item) => (
                    <li key={item._id}>
                        {item.name} - {item.quantity}
                        <button onClick={() => updateQuantity(item._id)}>Update</button>
                        <button onClick={() => deleteItem(item._id)}>Delete</button>
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default App;
