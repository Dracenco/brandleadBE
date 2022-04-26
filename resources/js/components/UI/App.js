import { useEffect, useState, useContext } from "react";
import './App.css';
import Input from './componets/Input'
import List from "./componets/List"
import {Col, Container, Row, ThemeProvider} from "react-bootstrap"
import { MyContext } from './context'
import { DndProvider } from 'react-dnd'
import { HTML5Backend } from 'react-dnd-html5-backend'


function App() {
    const myCtx = useContext(MyContext)

    useEffect(() => {
        const myAsync = async () => {
            const res = await fetch('https://dummyjson.com/products/1')
                .then(res => res.json())

            myCtx.setItems([...myCtx.items, res])
        }

        myAsync()
    }, [])

  return (
      <Container>
          <DndProvider backend={HTML5Backend}>
          <Row>
              <Col>
                  <div className="App">
                      <Input />
                      <List />
                  </div>
              </Col>
          </Row>
          </DndProvider>
      </Container>
  );
}

export default App;
