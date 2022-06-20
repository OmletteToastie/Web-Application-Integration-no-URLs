import React from 'react';
import { BrowserRouter,Routes, Route, Link } from 'react-router-dom';
import './App.css';
import HomePage from './components/HomePage';
import AuthorPage from './components/AuthorPage';
import PapersPage from './components/PapersPage';
import ReadingListPage from './components/ReadingListPage';
import ErrorPage from './components/ErrorPage';

/**
 * Component defines the routes to display the content on each page.
 * 
 * Unlike HTML, react implements a single page application. Meaning a single page is used, 
 * with other 'pages' deployed content to this single page rather than navigating to that page.
 * 
 * A nav bar is also defined on the page to assist in choosing what page content to show, a basepath is also set.
 * 
 * @author Ethan Borrill W18001798
 * @returns mixed App - The routes and navbar needed to view other pages, with a set basepath.
 */  
function App() {
  return(
    <BrowserRouter basename={"/kf6012/coursework/part2"}>
    <div className="App">
    <nav>
      <ul>
      <li><Link to ="/">Home</Link></li>
      <li><Link to ="papers">Papers</Link></li>
      <li><Link to ="authors">Authors</Link></li>
      <li><Link to ="readinglist">Reading List</Link></li>
      </ul>
    </nav>

      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="authors" element={<AuthorPage/>} />
        <Route path="papers" element={<PapersPage/>} />
        <Route path="readinglist" element={<ReadingListPage />}/>
        <Route path="*" element={<ErrorPage/>} />
      </Routes>
      </div>
      </BrowserRouter>
  );
    

}

export default App;
