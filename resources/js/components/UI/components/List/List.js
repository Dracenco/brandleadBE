import React, { useContext, useCallback } from 'react'
import update from 'immutability-helper'
import ListItem from './ListItem'
import { MyContext } from '../../context'
const style = {
    width: 400,
}
const List = () => {
    const myCtx = useContext(MyContext)
    console.log(myCtx)
    const moveItem = useCallback( (dragIndex, hoverIndex) => {
        myCtx.setItems((prevState) => {
            return update(prevState, {
                $splice: [
                    [dragIndex, 1],
                    [hoverIndex, 0, {...prevState[dragIndex],order: hoverIndex}],
                ]
            })
        })
    }, [])
    const renderItem = useCallback((item, index) => {
        return (
            <ListItem
                key={index}
                index={index}
                id={item.id}
                text={item.title}
                moveItem={moveItem}
            />
        )
    }, [])
    return (
        <div style={style}>
            {myCtx.items.map((el, k) => renderItem(el,k) )}
        </div>
    )
}

export default List