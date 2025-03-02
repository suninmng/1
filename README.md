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
