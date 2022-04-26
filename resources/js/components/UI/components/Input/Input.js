import { useContext, useState } from "react";
import {Form, Button, Row, Col} from 'react-bootstrap'
import { FaPlusSquare } from 'react-icons/fa'
import { MyContext } from '../../context'

const Input = () => {
    const [val, setVal] = useState()
    const myCtx = useContext(MyContext)

    const handleOnChange = (e) => {
        setVal(e.target.value)
    }

    const handleClick = async () => {
        // const res = await fetch('https://dummyjson.com/products/1')
        //     .then(res => res.json())

        myCtx.setItems([...myCtx.items, { title: val, order: myCtx.items.length }])
    }

    return (
        <Form>
            <Form.Group className="mb-3" controlId="formBasicPassword">
                <Row>
                    <Col xs={4}>
                        <Form.Label>Password</Form.Label>
                    </Col>
                    <Col>
                        <input type="text" placeholder="Enter name" onChange={handleOnChange} defaultValue={val} />
                    </Col>
                    <Col>
                        <Button onClick={handleClick}><FaPlusSquare /></Button>
                    </Col>
                </Row>
            </Form.Group>
        </Form>
    )
}

export default Input